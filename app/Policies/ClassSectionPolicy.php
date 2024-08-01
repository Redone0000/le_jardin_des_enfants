<?php

namespace App\Policies;

use App\Models\ClassSection;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClassSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ClassSection $classSection): bool
    {
        if ($user->role_id === 1) {
            return true;
        }

        // Vérifier si l'utilisateur est l'enseignant de la classe
        if ($user->id === $classSection->teacher->user_id) {
            return true;
        }

        // Vérifier si l'utilisateur est un parent d'un enfant dans la classe
        if ($user->role_id === 3) { 
            // Récupérer les IDs des classes des enfants de l'utilisateur
            $classIds = $user->tutor->children->pluck('class_id')->toArray();

            // Vérifier si la classe donnée est dans la liste des classes des enfants
            if (in_array($classSection->id, $classIds)) {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ClassSection $classSection): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ClassSection $classSection): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ClassSection $classSection): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ClassSection $classSection): bool
    {
        //
    }
}
