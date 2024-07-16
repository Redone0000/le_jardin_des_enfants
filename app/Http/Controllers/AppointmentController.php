<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvailableDate;
use App\Models\Appointment;
use App\Models\TimeSlot;
use Carbon\Carbon;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;


class AppointmentController extends Controller
{   
    public function showAvailableAppointments(Request $request)
    {
        // jours par page
        $perPage = 6;

        // numero page actuelle
        $currentPage = $request->get('page', 1);

        // Récupérer les dates
        $allDates = AvailableDate::with('timeSlots')->get();

        // exclure les samedis et dimanches
        $filteredDates = $allDates->filter(function ($date) {
            $dayOfWeek = \Carbon\Carbon::parse($date->date)->dayOfWeek;
            return $dayOfWeek != \Carbon\Carbon::SATURDAY && $dayOfWeek != \Carbon\Carbon::SUNDAY;
        });

        // pagination
        $offset = ($currentPage - 1) * $perPage;
        $availableDates = $filteredDates->slice($offset, $perPage);

        // Vérifiez s'il y a des pages précédentes ou suivantes
        $totalFilteredDates = $filteredDates->count();
        $hasPreviousPage = $currentPage > 1;
        $hasNextPage = $totalFilteredDates > ($currentPage * $perPage);

        return view('appointments.available', compact('availableDates', 'currentPage', 'hasPreviousPage', 'hasNextPage'));
    }


    public function formAppointment(Request $request) 
    {
        $day = $request->input('day');
        $hour = $request->input('hour');

        return view('appointments.form', compact('day', 'hour'));
    }

    public function appointment(Request $request)
    {    
        // Valider les données        
        $validatedData = $request->validate([
            'day' => 'required|date',
            'hour' => 'required|date_format:H:i',
            'child_last_name' => 'required|string',
            'child_first_name' => 'required|string',
            'child_birth_date' => 'required|date',
            'child_sex' => 'required|in:male,female',
            'parent_last_name' => 'required|string',
            'parent_first_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
        ]);

        // Convertir la date au bon format
        $day = Carbon::createFromFormat('d/m/Y', $validatedData['day'])->format('Y-m-d');

        // Extraire les données validées
        $hour = $validatedData['hour'];
        $email = $validatedData['email'];

        // Générer un token
        $token = Str::random(60);

        // Créer un nouvel enregistrement avec les données validées
        $appointment = Appointment::create(array_merge($validatedData, [
            'day' => $day,
            'token' => $token,
        ]));
        
        if($appointment) {
            // passer timeslot de 1 a 0
            $app = AvailableDate::where('date', $day)->first();
            $time = TimeSlot::where('available_date_id', $app->id)
                    ->where('start_time', $hour)
                    ->first();
            
            $time->is_available = 0;
            $time->save();

            $contactMail = new AppointmentMail($appointment);
            Mail::to('ridouan.sen@outlook.com')->send($contactMail);

        }   
        
        return redirect()->back()->with('success', 'Formulaire bien envoyé');

    }

    public function cancel(Request $request, $id, $token)
    {   
        $appointment = Appointment::findOrFail($id);
        if ($appointment && $appointment->token === $token ) {

            // Récuperation du jour et de l'heure pour passer is_available de 0 à 1
            $app = AvailableDate::where('date', $appointment->day)->first();
            $time = TimeSlot::where('available_date_id', $app->id)
                ->where('start_time', $appointment->hour)
                ->first();
        
            $time->is_available = 1;
            $time->save();


            $appointment->delete();
        } else {
            return redirect()->route('availableappointments')->with('error', 'Token invalide');
        }

        return redirect()->route('availableappointments')->with('success', 'Rendez-vous annulé avec succès');
    }

    public function appointmentsList()
    {   
        if (!Gate::allows('appointmentAccess', Appointment::class)) {
            // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
            abort(403);
        }
        $appointments = Appointment::all();

        return view('appointment.appointments-list', ['appointments' => $appointments]);
    }

    public function showAddAvailableDatesForm()
    {
        if (!Gate::allows('appointmentAccess', Appointment::class)) {
            // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
            abort(403);
        }

        return view('appointment.add_available_dates');

    }

    public function storeAvailableDates(Request $request)
    {   
        if (!Gate::allows('appointmentAccess', Appointment::class)) {
            // L'utilisateur actuel n'a pas la permission de voir le profil de l'enseignant
            abort(403);
        }
        
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        while ($startDate->lessThanOrEqualTo($endDate)) {
            $availableDate = AvailableDate::create(['date' => $startDate]);

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

        return redirect()->route('appointment.addAvailableDates')->with('success', 'Les dates ont été ajoutées avec succès.');
    }
}
