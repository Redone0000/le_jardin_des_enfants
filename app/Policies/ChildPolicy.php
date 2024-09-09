<?php

namespace App\Policies;

use App\Models\Child;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ChildPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Child $child): bool
    {
        // return $user->role_id === 1 || $user->id === $child->classe->teacher->user_id || $user->id === $child->tutor->user->id;
        return $user->role_id === 1 || $user->id === $child->classe->teacher->user_id || $user->role_id === 3;
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
    public function update(User $user, Child $child): bool
    {
        return $user->role_id === 1;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Child $child): bool
    {
        return $user->role_id === 1;
    }
}
