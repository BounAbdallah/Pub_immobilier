<?php

namespace App\Http\Controllers;

use App\Models\Annonce;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Affiche toutes les annonces pour les clients.
     */
    public function indexAnnonces()
{
    // Vérifier si l'utilisateur est un client ou un agent
    $user = Auth::user();

    // Vérifier le rôle de l'utilisateur
    if ($user->hasRole('client')) {
        // Si l'utilisateur est un client, récupérer toutes les annonces
        $annonces = Annonce::all();
    } elseif ($user->hasRole('agent')) {
        // Si l'utilisateur est un agent, récupérer uniquement ses propres annonces
        $annonces = Annonce::where('user_id', $user->id)->get();
    } else {
        // Si l'utilisateur n'a pas de rôle valide, rediriger vers une autre page
        $annonces = collect();
    }

    // Passer les annonces à la vue
    return view('client.dashboard', compact('annonces'));
}


    /**
     * Affiche les détails d'une annonce spécifique.
     */
    public function showAnnonce(Annonce $annonce)
    {
        return view('client.annonces.show', compact('annonce'));
    }

    /**
     * Permet à un client de faire une demande pour une annonce.
     */
    public function requestAnnonce(Request $request, Annonce $annonce)
    {
        // Validation de la demande
        $request->validate([
            'message' => 'required|string',
        ]);

        // Créer une nouvelle demande
        Demande::create([
            'user_id' => Auth::id(),    // ID de l'utilisateur connecté
            'annonce_id' => $annonce->id,  // ID de l'annonce
            'message' => $request->message, // Message envoyé
        ]);

        // Retourner à la vue précédente avec un message de succès
        return redirect()->route('client.annonces.index')->with('success', 'Votre demande a été envoyée avec succès.');
    }
}
