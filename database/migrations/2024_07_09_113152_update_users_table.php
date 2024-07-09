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
        Schema::table('users', function (Blueprint $table) {
            $table->string('login')->unique()->after('id');
            $table->string('lastname');
            $table->renameColumn('name', 'firstname');
            $table->string('phone');
            $table->unsignedBigInteger('role_id');

            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['login', 'firstname', 'lastname', 'phone', 'role_id']);
            $table->renameColumn('firstname', 'name');
        });
    }
};
