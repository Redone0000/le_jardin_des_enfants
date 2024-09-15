<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ChatController extends Controller
{   
    public function index()
    {   
        $admins = User::where('role_id', 1)->get();
        
        // Récupérer toutes les conversations de l'utilisateur connecté
        $conversations = Conversation::where(function($query) {
            $query->where('user1_id', Auth::id())
                ->orWhere('user2_id', Auth::id());
        })
        ->whereHas('messages')
        ->get();

         // Vérifier le rôle de l'utilisateur connecté
        $user = Auth::user();
        $teachers = [];

        if (Auth::user()->role_id == 3) {
            // Récupérer les enfants du parent connecté
            $children = Auth::user()->tutor->children;
    
            // Vérifier si des enfants sont trouvés
            if ($children->isNotEmpty()) {
                // Récupérer les enseignants pour chaque enfant
                foreach ($children as $child) {
                    $teacher = $child->classe->teacher;
    
                    // Vérifier si un enseignant est trouvé
                    if ($teacher) {
                        // Récupérer l'utilisateur associé à l'enseignant
                        $teacherUser = $teacher->user;
    
                        // Initialiser l'entrée pour cet enseignant s'il n'existe pas encore
                        if (!isset($teachers[$teacherUser->id])) {
                            $teachers[$teacherUser->id] = [
                                'teacher' => $teacherUser,
                                'children' => []
                            ];
                        }
                        $teachers[$teacherUser->id]['children'][] = $child->firstname;
                    }
                }
            }
        }

        // return view('chat.index', compact('conversations', 'admins'));
        return view('chat.index', compact('conversations', 'admins', 'teachers'));
    }


    public function show(Request $request, $id)
    {   
        // Récupérer toutes les conversations de l'utilisateur connecté
        $conversations = Conversation::where('user1_id', Auth::id())
                                    ->orWhere('user2_id', Auth::id())
                                    ->get();
                                    
        $conversation = Conversation::findOrFail($id);

        // Récupérer les messages de la conversation
        $messages = $conversation->messages()->get();

        return view('chat.show', compact('conversations', 'conversation', 'messages'));
    }


    public function store(Request $request)
    {
        // Stocker un nouveau message
        $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'conversation_id' => $request->conversation_id,
            'user_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->back();
    }

    public function createConversation(Request $request)
    {
        // Validation des données de la requête
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Vérifiez si la conversation existe déjà
        $existingConversation = Conversation::where(function ($query) use ($request) {
            $query->where('user1_id', Auth::id())
                ->where('user2_id', $request->user_id);
        })->orWhere(function ($query) use ($request) {
            $query->where('user1_id', $request->user_id)
                ->where('user2_id', Auth::id());
        })->first();

        if ($existingConversation) {
            // Rediriger vers la conversation existante
            return redirect()->route('chat.show', $existingConversation->id);
        }

        // Créer une nouvelle conversation
        $conversation = Conversation::create([
            'user1_id' => Auth::id(),
            'user2_id' => $request->user_id,
        ]);

        // Rediriger vers la nouvelle conversation
        return redirect()->route('chat.show', $conversation->id);
    }

    public function getMessages($id)
{
    $conversation = Conversation::findOrFail($id);
    $messages = $conversation->messages()->with('user')->get();

    return response()->json([
        'messages' => $messages->map(function ($message) {
            return [
                'user_id' => $message->user_id,
                'user_firstname' => $message->user->firstname,
                'user_lastname' => $message->user->lastname,
                'message' => $message->message,
            ];
        })
    ]);
}
}
