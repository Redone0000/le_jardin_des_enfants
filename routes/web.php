<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClassSectionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('mydashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Pages

Route::get('/', [PageController::class, 'home'])->name('page.home');
Route::get('/contact', [PageController::class, 'contact'])->name('page.contact');
Route::get('/teachers', [PageController::class, 'teachers'])->name('page.teachers');

// Appointment

Route::get('/appointments/available', [AppointmentController::class, 'showAvailableAppointments'])->name('availableappointments');

Route::get('/appointments/form', [AppointmentController::class, 'formAppointment'])->name('formAppointment');

Route::post('/appointments/form', [AppointmentController::class, 'appointment'])->name('appointment');

Route::get('/appointment/cancel/{id}/{token}', [AppointmentController::class, 'cancel'])->name('appointment.cancel');

Route::get('/add-available-dates', [AppointmentController::class, 'showAddAvailableDatesForm'])->name('appointment.addAvailableDates');

Route::get('/appointments-list', [AppointmentController::class, 'appointmentsList'])->name('appointment.list');

Route::post('/store-available-dates', [AppointmentController::class, 'storeAvailableDates'])->name('appointment.storeAvailableDates');

// Teachers

Route::get('teacher', [TeacherController::class, 'index'])->name('teacher.index');

Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');

Route::post('teacher/create', [TeacherController::class, 'store'])->name('teacher.store');

Route::get('/teacher/{id}', [TeacherController::class, 'show'])->where('id', '[0-9]+')->name('teacher.show');

Route::delete('/teacher/delete/{id}', [TeacherController::class, 'destroy'])->where('id', '[0-9]+')->name('teacher.delete');

Route::get('/teacher/edit/{id}', [TeacherController::class, 'edit'])->where('id', '[0-9]+')->name('teacher.edit');

Route::put('/teacher/update/{id}', [TeacherController::class, 'update'])->where('id', '[0-9]+')->name('teacher.update');

// ClassSection

// ClassSection

Route::get('/classes', [ClassSectionController::class, 'index'])->name('classes.index');

Route::get('/class/create', [ClassSectionController::class, 'create'])->name('class.create');

Route::post('/class/create', [ClassSectionController::class, 'store'])->name('class.store');

Route::get('/class/{id}', [ClassSectionController::class, 'show'])->name('class.show');

Route::get('/class/edit/{id}', [ClassSectionController::class, 'edit'])->name('class.edit');

Route::put('/class/edit/{id}', [ClassSectionController::class, 'update'])->where('id', '[0-9]+')->name('class.update');

Route::delete('/class/delete/{id}', [ClassSectionController::class, 'destroy'])->name('class.delete');

Route::get('/class/children/{id}', [ClassSectionController::class, 'getChild'])->name('class.children'); 

Route::get('/my-class', [ClassSectionController::class, 'showByClass'])->name('myclass');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
