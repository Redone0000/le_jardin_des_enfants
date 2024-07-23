<?php

namespace App\Policies;

use App\Models\User;

class ActivityTypePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Détermine si l'utilisateur peut afficher la liste des modèles.
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut afficher le modèle.
     */
    public function view(User $user, ActivityType $activityType)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut créer des modèles.
     */
    public function create(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour le modèle.
     */
    public function update(User $user, ActivityType $activityType)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut supprimer le modèle.
     */
    public function delete(User $user, ActivityType $activityType)
    {
        return $user->role_id === 1;
    }
}
