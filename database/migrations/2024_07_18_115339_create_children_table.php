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
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('class_id'); // Ajout de la colonne class_sections_id
            $table->foreign('class_id')->references('id')->on('class_sections');
            $table->string('lastname');
            $table->string('firstname');
            $table->enum('type', ['Type1', 'Type2'])->nullable();
            $table->enum('sexe', ['Male', 'Female'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('picture')->nullable();
            $table->unsignedBigInteger('tutor_id');
            $table->foreign('tutor_id')->references('id')->on('tutors');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
