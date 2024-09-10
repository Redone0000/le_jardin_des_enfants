<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['user1_id', 'user2_id'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    
    // Relation avec le modèle User pour user1
    public function user1()
    {
        return $this->belongsTo(User::class, 'user1_id');
    }

    // Relation avec le modèle User pour user2
    public function user2()
    {
        return $this->belongsTo(User::class, 'user2_id');
    }

    // Récupère les utilisateurs impliqués dans la conversation
    public function users()
    {
        // Ici, nous excluons l'utilisateur connecté s'il est inclus dans la conversation
        return User::whereIn('id', [$this->user1_id, $this->user2_id])
                    ->where('id', '!=', Auth::id())  // Exclure l'utilisateur connecté
                    ->get();
    }

    // Méthode pour obtenir les noms complets des utilisateurs
    public function getUsersFullName()
    {
        return $this->users()->map(function ($user) {
            return $user->firstname . ' ' . $user->lastname;
        })->join(' et ');
    }
}
