<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;

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
}
