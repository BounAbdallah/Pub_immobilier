<?php

namespace App\Policies;

use App\Models\Annonce;
use App\Models\User;

class AnnoncePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Annonce $annonce): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->hasRole('Agent');
    }

    public function update(User $user, Annonce $annonce): bool
    {
        return $user->hasRole('Agent') && $user->id === $annonce->user_id;
    }

    public function delete(User $user, Annonce $annonce): bool
    {
        return $user->hasRole('Admin') || ($user->hasRole('Agent') && $user->id === $annonce->user_id);
    }
}
