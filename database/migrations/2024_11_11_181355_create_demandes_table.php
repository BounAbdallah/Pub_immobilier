<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id'); // Référence au client
            $table->unsignedBigInteger('annonce_id'); // Référence à l'annonce
            $table->text('message'); // Message ou détails de la demande
            $table->timestamps();

            // Contraintes de clés étrangères avec noms explicites
            $table->foreign('client_id', 'demandes_client_id_foreign')
                  ->references('id')->on('users')->onDelete('cascade');
            $table->foreign('annonce_id', 'demandes_annonce_id_foreign')
                  ->references('id')->on('annonces')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Supprimer les contraintes de clé étrangère avant de supprimer la table 'demandes'
        Schema::table('demandes', function (Blueprint $table) {
            $table->dropForeign('demandes_client_id_foreign'); // Nom explicite de la clé étrangère 'client_id'
            $table->dropForeign('demandes_annonce_id_foreign'); // Nom explicite de la clé étrangère 'annonce_id'
        });

        // Supprimer la table 'demandes' si elle existe
        Schema::dropIfExists('demandes');
    }
};
