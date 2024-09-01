<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        return view ('events.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        if (!Gate::allows('create', Event::class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        $user = Auth::user(); // Récupère l'utilisateur connecté
        return view('events.create', ['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request)
    {   
        if (!Gate::allows('create', Event::class)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        $user_id = Auth::id(); // Récupère l'ID de l'utilisateur connecté

        Event::create([
            'user_id' => $user_id,
            'name' => $request->name,
            'description' => $request->description,
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('event.index')->with('success', 'Événement créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id); // Récupère l'événement par ID ou affiche une erreur 404
        return view('events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {   
        $event = Event::findOrFail($id);

        if (!Gate::allows('update', $event)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        return view('events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, string $id)
    {   
        $event = Event::findOrFail($id); // Récupère l'événement par ID ou affiche une erreur 404

        if (!Gate::allows('update', $event)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }

        // Met à jour les informations de l'événement
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('event.index')->with('success', 'Événement mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        // Trouver l'événement par ID ou générer une erreur 404 si non trouvé
        $event = Event::findOrFail($id);

        if (!Gate::allows('delete', $event)) {
            // Retourne une erreur 403 (accès interdit)
            abort(403);
        }
         

        if($event) {
            // Supprimer l'événement
            $event->delete();
        }
 
         // Rediriger vers la liste des événements avec un message de succès
         return redirect()->route('event.index')->with('success', 'Événement supprimé avec succès !');
    }
}
