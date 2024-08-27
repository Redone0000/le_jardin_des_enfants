<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Partner;
use Illuminate\Auth\Access\Response;

class PartnerPolicy
{

    /**
     * Détermine si l'utilisateur peut voir la liste des partenaires.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut voir un partenaire spécifique.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Partner $partner
     * @return bool
     */
    public function view(User $user, Partner $partner)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut créer un partenaire.
     *
     * @param \App\Models\User $user
     * @return bool
     */
    public function create(User $user)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut mettre à jour un partenaire spécifique.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Partner $partner
     * @return bool
     */
    public function update(User $user, Partner $partner)
    {
        return $user->role_id === 1;
    }

    /**
     * Détermine si l'utilisateur peut supprimer un partenaire spécifique.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Partner $partner
     * @return bool
     */
    public function delete(User $user, Partner $partner)
    {
        return $user->role_id === 1;
    }
}
