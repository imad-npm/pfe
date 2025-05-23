<?php


use App\Models\Speciality;
use App\Http\Controllers\Teacher\ContactController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Teacher\SubjectController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\TeamController;
use App\Http\Middleware\EnsureProposalPeriodIsActive;

Route::prefix("teacher")->middleware('auth:teacher')->group(function () {


    Route::get('dashboard',[DashboardController::class,"index"])->name('teacher.dashboard');

    Route::put('update-profile/{team}',[DashboardController::class,"updateProfile"])
    ->name('teacher.profile.update');
  
    Route::get('edit-profile',[DashboardController::class,"editProfile"])
    ->name('teacher.profile');

    Route::delete('destroy-profile',[DashboardController::class,"destroyProfile"])
    ->middleware(EnsureProposalPeriodIsActive::class) 
    ->name('teacher.profile.destroy');

  
    Route::prefix("contact")->group(function () {

        Route::post('submit', [ContactController::class, "submit"])
        ->middleware('throttle:contact')
        ->name('teacher.contact.submit');

        Route::get('', [ContactController::class, "show"])
        ->name('teacher.contact.show');
    }) ;
    Route::prefix("subjects")->group(function () {
    
        Route::get('create',[SubjectController::class,'create'])
        ->middleware(EnsureProposalPeriodIsActive::class)
        ->name("teacher.subjects.create") ;

        Route::post('store',[SubjectController::class,'store'])
        ->middleware(EnsureProposalPeriodIsActive::class)
        ->name('teacher.subjects.store') ;

        Route::put('{subject}',[SubjectController::class,'update'])
        ->middleware(EnsureProposalPeriodIsActive::class)
        ->name('teacher.subjects.update') ;

        Route::delete('{subject}',[SubjectController::class,'destroy'])
        ->middleware(EnsureProposalPeriodIsActive::class)
        ->name('teacher.subjects.destroy') ;
    
        Route::get('/{subject}/edit',[SubjectController::class,'edit'])
        ->middleware(EnsureProposalPeriodIsActive::class)
        ->name("teacher.subjects.edit") ;
    
    
        Route::get('/',[SubjectController::class,'index'])
        ->name("teacher.subjects.index") ;
    
    }) ;
    

    Route::prefix("external-teachers")->group(function () {

     
        Route::get("/",[TeacherController::class,"index"])
        ->name("teacher.teachers.index") ;
    
       Route::get("create",[TeacherController::class,"create"])
       ->middleware(EnsureProposalPeriodIsActive::class)
       ->name('teacher.teachers.create') ;
    
       Route::get("{teacher}/edit",[TeacherController::class,"edit"])
      
       ->name('teacher.teachers.edit');
    
       Route::put("{teacher}",[TeacherController::class,"update"])
      
       ->name('teacher.teachers.update');
       
       Route::post("store",[TeacherController::class,"store"])
       ->middleware(EnsureProposalPeriodIsActive::class)
       ->name('teacher.teachers.store');
    
       Route::delete('teachers/{teacher}',[TeacherController::class,'destroy'])
       ->middleware(EnsureProposalPeriodIsActive::class)
       ->name('teacher.teachers.destroy') ;
    
    }) ;

    Route::prefix("teams")->group(function () {
        Route::get('{team}',[TeamController::class,"show"])
        ->name('teacher.teams.show') ;
    }) ;
}) ;

