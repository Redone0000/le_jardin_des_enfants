<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AvailableDate;
use App\Models\TimeSlot;
use Carbon\Carbon;

class AvailableDatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2024, 6, 30); // Début de la plage de dates
        $endDate = Carbon::create(2024, 7, 15);   // Fin de la plage de dates

        while ($startDate->lessThanOrEqualTo($endDate)) {
            $availableDate = AvailableDate::create(['date' => $startDate]); // Créez la date
            
            // Ajouter des créneaux horaires pour chaque jour
            $availableDate->timeSlots()->createMany([
                ['start_time' => '09:00', 'end_time' => '10:00'],
                ['start_time' => '10:00', 'end_time' => '11:00'],
                ['start_time' => '11:00', 'end_time' => '12:00'],
                ['start_time' => '13:00', 'end_time' => '14:00'],
                ['start_time' => '14:00', 'end_time' => '15:00'],
                ['start_time' => '15:00', 'end_time' => '16:00'],
            ]);

            $startDate->addDay();
        }
    }
}
