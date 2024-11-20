<?php
namespace Database\Factories;

use App\Models\Annonce;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    protected $model = Annonce::class;

    public function definition(): array
    {
        return [
            'titre' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'prix' => $this->faker->randomFloat(2, 100, 1000), // Prix avec deux décimales
            'localisation' => $this->faker->city, // Utilisation d'une ville pour la localisation
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'user_id' => User::factory(), // Associer chaque annonce à un utilisateur aléatoire
            'images_path' => json_encode([$this->faker->imageUrl()]), // Ajouter une URL d'image aléatoire
        ];
    }
}

