<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Détermine si l'utilisateur authentifié peut mettre à jour le rôle d'un utilisateur donné.
     */
    public function updateRole(User $authUser, User $targetUser): bool
    {
        // Seul un administrateur peut mettre à jour le rôle des utilisateurs
        return $authUser->hasRole('admin');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Exemple : seul un administrateur peut voir tous les utilisateurs
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        // Exemple : les administrateurs peuvent voir les détails de tout utilisateur
        return $user->hasRole('admin') || $user->id === $model->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Exemple : seuls les administrateurs peuvent créer de nouveaux utilisateurs
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        // Seul un administrateur peut mettre à jour les informations générales d'un utilisateur
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // Exemple : seuls les administrateurs peuvent supprimer un utilisateur
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        // Exemple : seuls les administrateurs peuvent restaurer un utilisateur
        return $user->hasRole('admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        // Exemple : seuls les administrateurs peuvent supprimer définitivement un utilisateur
        return $user->hasRole('admin');
    }
}
