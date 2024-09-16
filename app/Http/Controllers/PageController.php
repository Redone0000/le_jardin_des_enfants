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

        if($user->role_id === 1) {
            $children = Child::all();
            $activities = Activity::all();
            $appointments = Appointment::all();
            $classes = ClassSection::all();
            $reservations = Reservation::all();
        } elseif($user->role_id === 2) {
            $children =  Child::where('class_id', $user->teacher->class_id)->get();
        } elseif($user->role_id === 3) {
            $children = $user->tutor->children;
        }
        
        $events = Event::all();

        return view('mydashboard', compact('children', 'activities', 'events', 'appointments', 'classes', 'reservations'));
    }
}
