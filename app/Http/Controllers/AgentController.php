<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Demande;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Affiche le tableau de bord de l'agent avec ses annonces.
     */
    public function dashboard()
    {
        // Modifié : utilise user_id pour récupérer les annonces de l'agent
        $annonces = Annonce::where('user_id', auth()->id())->get();
    
        // Si nécessaire, initialiser une collection vide
        if ($annonces->isEmpty()) {
            $annonces = collect();
        }
    
        return view('agent.dashboard', compact('annonces'));
    }
    
    /**
     * Affiche le formulaire de création d'une nouvelle annonce.
     */
    public function create()
    {
        return view('agent.annonces.create');
    }

    /**
     * Enregistre une nouvelle annonce.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
            'localisation' => 'required|string|max:255',
        ]);

        // Création de l'annonce
        $annonce = new Annonce();
        $annonce->titre = $validated['titre'];
        $annonce->prix = $validated['prix'];
        $annonce->description = $validated['description'];
        $annonce->localisation = $validated['localisation'];
        $annonce->user_id = Auth::id(); // L'agent connecté est l'auteur de l'annonce
        $annonce->save();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('agent.dashboard')->with('success', 'Annonce créée avec succès');
    }

    /**
     * Affiche le formulaire pour modifier une annonce.
     */
    public function edit($id)
    {
        // Récupère l'annonce à modifier
        $annonce = Annonce::findOrFail($id);

        // Vérifie que l'utilisateur est bien l'agent propriétaire de l'annonce
        if ($annonce->user_id != Auth::id()) {
            return redirect()->route('agent.dashboard')->with('error', 'Vous ne pouvez pas modifier cette annonce');
        }

        return view('agent.annonces.edit', compact('annonce'));
    }

    /**
     * Met à jour une annonce existante.
     */
    public function update(Request $request, $id)
    {
        // Validation des données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
            'localisation' => 'required|string|max:255',
        ]);

        // Récupère l'annonce à mettre à jour
        $annonce = Annonce::findOrFail($id);

        // Vérifie que l'utilisateur est bien l'agent propriétaire de l'annonce
        if ($annonce->user_id != Auth::id()) {
            return redirect()->route('agent.dashboard')->with('error', 'Vous ne pouvez pas modifier cette annonce');
        }

        // Mise à jour de l'annonce
        $annonce->titre = $validated['titre'];
        $annonce->prix = $validated['prix'];
        $annonce->description = $validated['description'];
        $annonce->localisation = $validated['localisation'];
        $annonce->save();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('agent.dashboard')->with('success', 'Annonce mise à jour avec succès');
    }

    /**
     * Supprime une annonce.
     */
    public function destroy($id)
    {
        // Récupère l'annonce à supprimer
        $annonce = Annonce::findOrFail($id);

        // Vérifie que l'utilisateur est bien l'agent propriétaire de l'annonce
        if ($annonce->user_id != Auth::id()) {
            return redirect()->route('agent.dashboard')->with('error', 'Vous ne pouvez pas supprimer cette annonce');
        }

        // Suppression de l'annonce
        $annonce->delete();

        // Redirection vers le tableau de bord avec un message de succès
        return redirect()->route('agent.dashboard')->with('success', 'Annonce supprimée avec succès');
    }

    /**
     * Affiche toutes les demandes associées aux annonces de l'agent.
     */
    public function demandes()
    {
        // Récupère toutes les demandes de l'agent
        $demandes = Demande::whereHas('annonce', function ($query) {
            $query->where('user_id', Auth::id());
        })->get();

        // Passe les demandes à la vue
        return view('agent.demandes.index', compact('demandes'));
    }
}
