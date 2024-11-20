<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demande;
use App\Models\Annonce;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class AdminController extends Controller
{
    use AuthorizesRequests;

    /**
     * Affiche la liste des utilisateurs pour la gestion des rôles.
     */
    public function indexUsers()
    {
        $users = User::all(); // Récupération de tous les utilisateurs
        return view('admin.users.index', compact('users'));
    }

    /**
     * Met à jour le rôle d'un utilisateur.
     */
    public function updateUserRole(Request $request, User $user)
    {
        // Vérification si l'admin peut mettre à jour le rôle
        $this->authorize('update', $user);

        // Validation de la requête
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Mise à jour du rôle
        $user->syncRoles([$request->role]);

        // Redirection avec message de succès
        return redirect()->route('admin.users.index')->with('success', 'Le rôle de l\'utilisateur a été mis à jour.');
    }

    /**
     * Affiche les statistiques de la plateforme.
     */
    public function showStatistiques()
    {
        // Compter les différents types d'entités
        $totalAnnonces = Annonce::count(); // Nombre total d'annonces
        $totalDemandes = Demande::count(); // Nombre total de demandes
        $totalClients = User::role('client')->count(); // Nombre total de clients
        $totalAgents = User::role('agent')->count(); // Nombre total d'agents

        // Retourner les statistiques à la vue
        return view('admin.statistiques', compact('totalAnnonces', 'totalDemandes', 'totalClients', 'totalAgents'));
    }
}
