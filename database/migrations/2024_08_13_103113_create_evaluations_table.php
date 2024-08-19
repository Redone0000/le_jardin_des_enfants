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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            
            // Définition des clés étrangères
            $table->unsignedBigInteger('activity_id');
            $table->unsignedBigInteger('child_id');

            $table->integer('grade');
            $table->text('feedback')->nullable();
            
            $table->timestamps();

            // Définition des contraintes de clés étrangères
            $table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
            $table->foreign('child_id')->references('id')->on('children')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluations', function (Blueprint $table) {
            // Supprimer les clés étrangères avant de supprimer la table
            $table->dropForeign(['activity_id']);
            $table->dropForeign(['child_id']);
        });

        Schema::dropIfExists('evaluations');
    }
};
