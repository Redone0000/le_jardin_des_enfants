<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ActivityType;

class ActivityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [

            ['category' => 'français', 'name' => 'Écouter et parler', 'description' => 'Activités visant à développer les compétences orales.'],
            ['category' => 'français', 'name' => 'Lire et écrire', 'description' => 'Activités visant à développer les compétences en lecture et écriture.'],


            ['category' => 'Education culturelle et artistique', 'name' => 'Expression plastique', 'description' => 'Activités d\'art plastique et de créativité.'],
            ['category' => 'Education culturelle et artistique', 'name' => 'Expression française et corporelle', 'description' => 'Activités d\'expression corporelle et dramatique.'],
            ['category' => 'Education culturelle et artistique', 'name' => 'Expression musicale', 'description' => 'Activités musicales et de découverte des instruments.'],

            ['category' => 'mathématique', 'name' => 'Les nombres et opérations', 'description' => 'Activités pour apprendre les nombres et les opérations.'],
            ['category' => 'mathématique', 'name' => 'Les solides et figures', 'description' => 'Activités sur les formes géométriques et solides.'],
            ['category' => 'mathématique', 'name' => 'Grandeurs', 'description' => 'Activités sur les mesures et les grandeurs.'],
            ['category' => 'mathématique', 'name' => 'Traitement de données', 'description' => 'Activités pour apprendre le traitement des données.'],

            ['category' => 'science', 'name' => 'Le vivant', 'description' => 'Activités pour découvrir les êtres vivants.'],
            ['category' => 'science', 'name' => 'La matière', 'description' => 'Activités sur les propriétés de la matière.'],
            ['category' => 'science', 'name' => 'L\'air, l\'eau, le sol', 'description' => 'Activités pour étudier l\'air, l\'eau et le sol.'],
            ['category' => 'science', 'name' => 'La météo', 'description' => 'Activités pour comprendre la météorologie.'],
            ['category' => 'science', 'name' => 'L\'énergie (3ème seulement)', 'description' => 'Activités sur les différents types d\'énergie, réservées à la 3ème année.'],
            ['category' => 'science', 'name' => 'L\'environnement', 'description' => 'Activités pour sensibiliser à l\'environnement.'],

            ['category' => 'Sciences humaines Philosophie-Citoyenneté', 'name' => 'Explorer l\'espace', 'description' => 'Activités pour découvrir l\'espace et la géographie.'],
            ['category' => 'Sciences humaines Philosophie-Citoyenneté', 'name' => 'Explorer le temps', 'description' => 'Activités pour comprendre l\'histoire et le temps.'],
            ['category' => 'Sciences humaines Philosophie-Citoyenneté', 'name' => 'Explorer le monde dans le temps et l\'espace (3ème uniquement)', 'description' => 'Activités combinant histoire et géographie, réservées à la 3ème année.'],


            ['category' => 'Education physique, Bien-être et Santé', 'name' => 'Habilités motrices et expression', 'description' => 'Activités pour développer les compétences motrices et l\'expression corporelle.'],
            ['category' => 'Education physique, Bien-être et Santé', 'name' => 'Habilités sociomotrices et citoyenneté', 'description' => 'Activités pour développer les compétences sociales et motrices.'],
            ['category' => 'Education physique, Bien-être et Santé', 'name' => 'Gestion de sa santé et de la sécurité', 'description' => 'Activités pour apprendre la gestion de la santé et la sécurité personnelle.'],
            ['category' => 'Education physique, Bien-être et Santé', 'name' => 'Psychomotricité fine', 'description' => 'Activités pour développer la motricité fine.'],
        ];

        foreach ($activities as $activity) {
            ActivityType::create($activity);
        }
    }
}
