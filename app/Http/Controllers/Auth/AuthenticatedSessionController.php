<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Afficher la vue de connexion.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Gérer une requête d'authentification entrante.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentification de l'utilisateur
        $request->authenticate();

        // Regénérer la session pour prévenir les attaques par fixation de session
        $request->session()->regenerate();

        // Rediriger selon le rôle de l'utilisateur
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('agent')) {
            return redirect()->route('agent.dashboard');
        } elseif ($user->hasRole('client')) {
            return redirect()->route('client.dashboard');
        }

        // Par défaut, rediriger vers le tableau de bord principal
        return redirect()->route('dashboard');
    }

    /**
     * Détruire une session authentifiée.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        // Invalider la session et régénérer le token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
