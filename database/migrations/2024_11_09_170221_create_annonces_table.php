<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();

            // Définir explicitement la clé étrangère et la colonne correspondante
            $table->foreignId('user_id')
                  ->constrained('users', 'id')  // Référence explicite à la table 'users' et la colonne 'id'
                  ->onDelete('cascade');        // Suppression en cascade des annonces liées à un utilisateur supprimé

            $table->string('titre');
            $table->text('description');
            $table->decimal('prix', 10, 2);
            $table->string('localisation');
            $table->decimal('latitude', 10, 8);  // Ajout du champ latitude
            $table->decimal('longitude', 11, 8); // Ajout du champ longitude
            $table->json('images_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Vérification si des tables ont des contraintes avec 'annonces'
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropForeign(['annonce_id']); // Exemple de suppression de la contrainte de clé étrangère dans une autre table
        });

        // Ensuite, on peut supprimer la table 'annonces'
        Schema::dropIfExists('annonces');
    }
};
