<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * Les attributs qui ne peuvent pas être assignés en masse.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'guared', // Ajouter le champ guared ici pour éviter l'assignation en masse
    ];

    /**
     * Les attributs qui doivent être masqués pour la sérialisation.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',       // Masquer le mot de passe
        'remember_token', // Masquer le token de connexion
    ];

    /**
     * Les attributs qui doivent être convertis en types spécifiques.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Définir la relation entre l'utilisateur et ses annonces.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function annonces()
    {
        return $this->hasMany(Annonce::class); // Un utilisateur peut avoir plusieurs annonces
    }
}
