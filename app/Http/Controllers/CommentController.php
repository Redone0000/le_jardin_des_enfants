<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valider les données du formulaire
        $validatedData = $request->validate([
            'comment' => 'required|string|max:1000',
            'activity_id' => 'required|exists:activities,id',
        ]);

        // Récupérer l'activité à laquelle le commentaire est lié
        $activity = Activity::findOrFail($validatedData['activity_id']);

        // Créer le commentaire
        $comment = new Comment();
        $comment->content = $validatedData['comment'];
        $comment->user_id = Auth::id(); // Assigner l'ID de l'utilisateur connecté
        $comment->activity_id = $activity->id; // Assigner l'ID de l'activité
        $comment->save();

        // Rediriger l'utilisateur avec un message de succès
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {   
    //     $comment = Comment::findOrFail($id);
    //     if (Auth::user()->id !== $comment->user_id) {
    //         abort(403);
    //     }
    //     return view('comments.edit', compact('comment'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $comment = Comment::findOrFail($id);
        if (Auth::user()->id !== $comment->user_id) {
            abort(403);
        }

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $comment->update([
            'content' => $request->input('content'),
        ]);

        return redirect()->back()->with('status', 'Comment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        $comment = Comment::findOrFail($id);

        // Vérifiez que l'utilisateur est autorisé à supprimer ce commentaire
        if ($request->user()->id !== $comment->user_id) {
            return redirect()->back()->withErrors('Unauthorized action.');
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}
