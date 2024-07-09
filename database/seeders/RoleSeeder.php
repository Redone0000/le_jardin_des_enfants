<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Désactiver la vérification des clés étrangères
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    // Tronquer la table "roles"
    Role::truncate();

    // Réactiver la vérification des clés étrangères
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    $roles = [
        [
            'name' => 'admin',   
        ],
        [
            'name' => 'teacher',  
        ],
        [
            'name' => 'tutor', 
        ]
    ];

    foreach ($roles as $role) {
        Role::create($role);
    }
    }
}
