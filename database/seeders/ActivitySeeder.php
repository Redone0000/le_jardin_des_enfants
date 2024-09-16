<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Activity;
use Illuminate\Support\Facades\DB;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insérer plusieurs activités avec des données brutes
        Activity::insert([
            [
                'title' => 'Peinture créative',
                'description' => 'Atelier de peinture pour stimuler la créativité des enfants.',
                'class_id' => 2, // Classe prédéfinie (brut)
                'activity_type_id' => 1, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Atelier d\'écriture',
                'description' => 'Atelier pour apprendre à écrire des petites histoires.',
                'class_id' => 3, // Classe prédéfinie (brut)
                'activity_type_id' => 2, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jeux en plein air',
                'description' => 'Activités en extérieur pour encourager le développement physique.',
                'class_id' => 7, // Classe prédéfinie (brut)
                'activity_type_id' => 3, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Lecture de contes',
                'description' => 'Séance de lecture pour développer l\'imagination des enfants.',
                'class_id' => 8, // Classe prédéfinie (brut)
                'activity_type_id' => 1, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Atelier de théâtre',
                'description' => 'Les enfants apprennent à exprimer leurs émotions à travers le théâtre.',
                'class_id' => 2, // Classe prédéfinie (brut)
                'activity_type_id' => 1, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Danse et mouvements',
                'description' => 'Cours de danse pour développer les compétences motrices et la coordination.',
                'class_id' => 3, // Classe prédéfinie (brut)
                'activity_type_id' => 19, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cuisine pour enfants',
                'description' => 'Les enfants apprennent à cuisiner des recettes simples et amusantes.',
                'class_id' => 7, // Classe prédéfinie (brut)
                'activity_type_id' => 19, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Sciences amusantes',
                'description' => 'Atelier de découverte des sciences avec des expériences amusantes pour les enfants.',
                'class_id' => 8, // Classe prédéfinie (brut)
                'activity_type_id' => 10, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Artisanat et bricolage',
                'description' => 'Création de différents objets à partir de matériaux recyclés.',
                'class_id' => 2, // Classe prédéfinie (brut)
                'activity_type_id' => 3, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Atelier musical',
                'description' => 'Découverte des instruments de musique et apprentissage des bases musicales.',
                'class_id' => 3, // Classe prédéfinie (brut)
                'activity_type_id' => 5, // Type prédéfini (brut)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
