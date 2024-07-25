<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ClassSectionController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\ActivityTypeController;
use App\Http\Controllers\ActivityController;


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

Route::get('/classes', [ClassSectionController::class, 'index'])->name('classes.index');

Route::get('/class/create', [ClassSectionController::class, 'create'])->name('class.create');

Route::post('/class/create', [ClassSectionController::class, 'store'])->name('class.store');

Route::get('/class/{id}', [ClassSectionController::class, 'show'])->name('class.show');

Route::get('/class/edit/{id}', [ClassSectionController::class, 'edit'])->name('class.edit');

Route::put('/class/edit/{id}', [ClassSectionController::class, 'update'])->where('id', '[0-9]+')->name('class.update');

Route::delete('/class/delete/{id}', [ClassSectionController::class, 'destroy'])->name('class.delete');

Route::get('/class/children/{id}', [ClassSectionController::class, 'getChild'])->name('class.children'); 

Route::get('/my-class', [ClassSectionController::class, 'showByClass'])->name('myclass');

// Child

Route::get('children', [ChildController::class, 'index'])->name('children.index');

Route::get('child/create', [ChildController::class, 'create'])->name('child.create');

Route::post('child/create', [ChildController::class, 'store'])->name('child.store');

Route::get('child/{id}', [ChildController::class, 'show'])->name('child.show');

Route::get('/child/edit/{id}', [ChildController::class, 'edit'])->where('id', '[0-9]+')->name('child.edit');

Route::delete('/child/delete/{id}', [ChildController::class, 'destroy'])->where('id', '[0-9]+')->name('child.delete');

Route::put('/child/update/{id}', [ChildController::class, 'update'])->where('id', '[0-9]+')->name('child.update');

// ActivityType

Route::get('/activity-types', [ActivityTypeController::class, 'index'])->name('activity-types.index');

Route::get('/activity-types/create', [ActivityTypeController::class, 'create'])->name('activity-types.create');

Route::post('activity-types', [ActivityTypeController::class, 'store'])->name('activity-types.store');

Route::get('activity-types/{id}', [ActivityTypeController::class, 'show'])->name('activity-types.show');

Route::get('activity-types/{id}/edit', [ActivityTypeController::class, 'edit'])->name('activity-types.edit');

Route::put('activity-types/{id}', [ActivityTypeController::class, 'update'])->name('activity-types.update');

Route::delete('activity-types/{id}', [ActivityTypeController::class, 'destroy'])->name('activity-types.destroy');


// Activity

Route::get('/activities', [ActivityController::class, 'index'])->name('activity.index');

Route::get('/activity-create', [ActivityController::class, 'create'])->name('activity.create');

Route::post('/activity-create', [ActivityController::class, 'store'])->name('activity.store');




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
