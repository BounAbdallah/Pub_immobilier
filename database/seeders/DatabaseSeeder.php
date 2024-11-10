<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crée 10 utilisateurs avec des données générées aléatoirement
        // User::factory(10)->create();

        // Crée un utilisateur de test avec des informations spécifiques
        User::factory()->create([
            'nom' => 'Test',
            'prenom' => 'User',
            'adresse' => '123 Rue Exemple',
            'numero' => '123456789',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),  // Ajout du mot de passe
        ]);
    }
}

