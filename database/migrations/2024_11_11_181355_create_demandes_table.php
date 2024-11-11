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
            
            // Contraintes de clés étrangères
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('annonce_id')->references('id')->on('annonces')->onDelete('cascade');
        });
    }
};
