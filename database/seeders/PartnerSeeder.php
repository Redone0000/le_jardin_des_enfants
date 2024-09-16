<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $partners = [
            [
                'name' => 'Bibliothèque Royale de Belgique',
                'description' => 'Une grande bibliothèque nationale offrant une riche collection de livres et de ressources.',
                'address' => '2 Boulevard de l’Empereur, 1000 Bruxelles',
                'phone' => '+32 2 553 45 67',
                'website' => 'https://www.kbr.be',
                'picture' => '', 
            ],
            [
                'name' => 'Piscine du Centre Sportif de Liège',
                'description' => 'Piscine olympique avec divers équipements pour la natation et les loisirs.',
                'address' => '1 Rue du Pré au Bois, 4000 Liège',
                'phone' => '+32 4 232 34 56',
                'website' => 'https://www.csl.be',
                'picture' => '', 
            ],
            [
                'name' => 'Centre Culturel de Namur',
                'description' => 'Centre proposant des ateliers d\'art, des expositions et des événements culturels.',
                'address' => '10 Place du Théâtre, 5000 Namur',
                'phone' => '+32 81 24 56 78',
                'website' => 'https://www.centrecultureldenamur.be',
                'picture' => '',
            ],
            [
                'name' => 'Parc du Cinquantenaire',
                'description' => 'Un grand parc à Bruxelles avec des espaces verts pour des activités pédagogiques et récréatives.',
                'address' => 'Cinquantenaire, 1000 Bruxelles',
                'phone' => '+32 2 737 21 22',
                'website' => 'https://www.parcducinquantenaire.be',
                'picture' => '', 
            ],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
