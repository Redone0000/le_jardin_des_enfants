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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('day'); 
            $table->time('hour'); 
            $table->string('child_last_name');
            $table->string('child_first_name'); 
            $table->date('child_birth_date'); 
            $table->enum('child_sex', ['female', 'male']); 
            $table->string('parent_last_name'); 
            $table->string('parent_first_name'); 
            $table->string('phone_number', 15);
            $table->string('email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
