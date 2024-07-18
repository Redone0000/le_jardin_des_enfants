<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'name' => 'Accueil',
                'description' => 'Section pour l\'accueil des tout-petits en maternelle',
            ],
            [
                'name' => 'Petite Section',
                'description' => 'Section pour les plus jeunes enfants en maternelle',
            ],
            [
                'name' => 'Moyenne Section',
                'description' => 'Section pour les enfants de taille moyenne en maternelle',
            ],
            [
                'name' => 'Grande Section',
                'description' => 'Section pour les enfants plus âgés en maternelle',
            ],
        ];

        // Insérer les sections dans la base de données
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
