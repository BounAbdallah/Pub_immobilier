<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class LoginRequest extends FormRequest
{
    /**
     * Déterminez si l'utilisateur est autorisé à effectuer cette demande.
     */
    public function authorize(): bool
    {
        return true;  // Autorise toutes les requêtes
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }

    /**
     * Tentez d'authentifier l'utilisateur avec les informations de connexion.
     */
    public function authenticate()
    {
        if (!Auth::attempt($this->only('email', 'password'))) {
            // L'authentification a échoué, générer une exception
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => 'Les informations d\'identification ne correspondent pas.',
            ]);
        }
    }
}
