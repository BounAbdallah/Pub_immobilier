<?php

// app/Providers/AuthServiceProvider.php
namespace App\Providers;

use App\Models\Annonce;
use App\Policies\AnnoncePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Les politiques (policies) associées aux modèles.
     *
     * @var array
     */
    protected $policies = [
        Annonce::class => AnnoncePolicy::class, // Enregistrement de la policy pour Annonce
    ];

    /**
     * Enregistre les services pour l'application.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies(); // Enregistrement des politiques par défaut

        // Vous pouvez définir des Gates supplémentaires ici si nécessaire
    }
}
