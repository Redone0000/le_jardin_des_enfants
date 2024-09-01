<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Partner;
use App\Models\ClassSection;

class PageController extends Controller
{   
    public function home()
    {
        return view('welcome');
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
}
