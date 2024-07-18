<?php

namespace App\Policies;

use App\Models\User;

class AppointmentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can view any models.
     */
    public function appointmentAccess(User $user): bool
    {
        return $user->role_id === 1;
    }

}
