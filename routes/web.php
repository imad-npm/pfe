<?php

use App\Models\Speciality;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;


Route::get('', function () {
    return view('public.welcome');
});

Route::post('contact', [ContactController::class, "submit"])
->middleware('throttle:contact')
->name('contact.submit');


Route::prefix("subjects")->group(function () {
    Route::get('', [SubjectController::class, 'index'])
        ->name("subjects.index");

    Route::get('/{subject}', [SubjectController::class, 'show'])->name("subjects.show");
});

Route::prefix("teachers")->group(function () {

    Route::get('{teacher}', [TeacherController::class, 'show'])
        ->name("teachers.show");
});

require __DIR__ . '/admin.php';
require __DIR__ . '/teacher.php';
require __DIR__ . '/team.php';

require __DIR__ . '/auth-team.php';
require __DIR__ . '/auth-admin.php';

require __DIR__ . '/auth-teacher.php';
