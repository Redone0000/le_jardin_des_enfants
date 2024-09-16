<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Partner;
use App\Models\Section;
use App\Models\ClassSection;
use App\Models\Event;
use App\Models\Child;
use App\Models\Activity;
use App\Models\Appointment;
use App\Models\Reservation;

class PageController extends Controller
{   
    public function home()
    {   
        $sections = Section::all();

        return view('welcome', compact('sections'));
    }
    
    public function contact()
    {
        return view('pages.contact');
    }

    public function teachers()
    {   
        $teachers = Teacher::all();

        return view('pages.teachers', compact('teachers'));
    }

    public function classes()
    {   
        $classes = ClassSection::all();

        return view('pages.classes', compact('classes'));
    }

    public function partners()
    {   
        $partners = Partner::all();

        return view('pages.partners', compact('partners'));
    }

    public function events()
    {   
        $events = Event::all();

        return view('pages.events', compact('events'));
    }

    public function about()
    {   
        return view('pages.about');
    }

    public function dashboard() {
        $user = auth()->user();
        $appointments = null; 
        $classes = null;
        $reservations = null;
        $evaluations = null;
        $activities = null;
    
        if ($user->role_id === 1) {
            // Administrateur
            $children = Child::all();
            $activities = Activity::all();
            $appointments = Appointment::all();
            $classes = ClassSection::all();
            $reservations = Reservation::all();
        } elseif ($user->role_id === 2) {
            // Enseignant
            $class = ClassSection::where('teacher_id', $user->teacher->id)->first(); // Classes de l'enseignant
            
            if($class) {
            $children = Child::where('class_id', $class->id)->get();   // Enfants de la classe
            $activities = $class->activities()->get();

            // $evaluations = $activities->evaluations()->get(); // Évaluations des enfants
            $evaluations = $children->flatMap(function ($child) {
                return $child->evaluations;  // Ici on récupère les évaluations via chaque enfant
            });
            } else {
                // Si l'enseignant n'a pas de classe
                $children = collect();  // Collection vide pour éviter les erreurs
                $activities = collect();  // Collection vide pour éviter les erreurs
                $evaluations = collect();  // Collection vide pour éviter les erreurs
            }
    
        } elseif ($user->role_id === 3) {
            // Tuteurs
            $children = $user->tutor->children;
    
            $reservations = $children->map(function ($child) {
                return $child->reservations;
            })->flatten();
    
            $evaluations = $children->map(function ($child) {
                return $child->evaluations;
            });
    
            $classes = $children->map(function($child) {
                return $child->classe;
            })->unique();
    
            $activities = $classes->flatMap(function($class) {
                return $class->activities;
            });
        }
    
        $events = Event::all(); // Récupérer tous les événements
    
        return view('mydashboard', compact('children', 'activities', 'events', 'appointments', 'classes', 'reservations', 'evaluations'));
    }
    
}
