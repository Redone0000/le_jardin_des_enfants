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
use App\Http\Controllers\EventController;
use App\Http\Controllers\EvaluationController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // return view('dashboard');
    return view('mydashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

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

Route::get('/appointments-list', [AppointmentController::class, 'appointmentsList'])->name('appointments.list');

Route::post('/store-available-dates', [AppointmentController::class, 'storeAvailableDates'])->name('appointment.storeAvailableDates');

Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');


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

Route::delete('/child/delete/{id}', [ChildController::class, 'destroy'])->name('child.delete');

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

Route::get('/activity/{id}', [ActivityController::class, 'show'])->name('activity.show');

Route::get('activity/{id}/edit', [ActivityController::class, 'edit'])->name('activity.edit');

Route::put('activity/{id}', [ActivityController::class, 'update'])->name('activity.update');

Route::delete('/activity/{id}', [ActivityController::class, 'destroy'])->where('id', '[0-9]+')->name('activity.delete');



// Event

Route::get('events', [EventController::class, 'index'])->name('event.index');

Route::get('event/create', [EventController::class, 'create'])->name('event.create');

Route::post('events', [EventController::class, 'store'])->name('event.store');

Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');

Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');

Route::put('event/{id}', [EventController::class, 'update'])->name('event.update');

Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');

// Evaluation

// Route::get('evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');

Route::get('/activities/{activity}/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');

// Route::get('evaluations/create/{id}', [EvaluationController::class, 'create'])->name('evaluation.create');

Route::get('evaluations/create/{activity_id}/{child_id}', [EvaluationController::class, 'create'])->name('evaluation.create');

Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

// Route::get('evaluations/{activity}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');

// Route::put('evaluations/{activity}', [EvaluationController::class, 'update'])->name('evaluations.update');

Route::get('/evaluations/{evaluation}/edit', [EvaluationController::class, 'edit'])->name('evaluations.edit');

Route::put('/evaluations/{evaluation}', [EvaluationController::class, 'update'])->name('evaluations.update');

Route::delete('/evaluations/{id}', [EvaluationController::class, 'destroy'])->name('evaluations.destroy');

Route::get('/tutors/evaluations', [EvaluationController::class, 'showEvaluationsForConnectedTutor'])
    ->name('tutor.evaluations');
    
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
