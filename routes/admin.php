<?php

use App\Models\Speciality;
use App\Constants\TeacherType;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\ChoiceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmailTeacherController;
use App\Http\Controllers\Admin\ImportantDateController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SpecialityController;
use App\Http\Middleware\EnsureChoicePeriodIsNotActive;
use App\Http\Middleware\EnsureProposalPeriodIsActive;
use App\Http\Middleware\TeamVerified;
use App\Models\EmailTeacher;

Route::prefix("admin")->middleware('auth:admin')->group(function () {

    Route::get('dashboard',[DashboardController::class,"index"])
    ->name('admin.dashboard');

    Route::prefix("assignments")->group(function () {
        Route::get('assign',[AssignmentController::class,"assign"])
    ->name('admin.assignments.assign') ;

    Route::get('new-session',[AssignmentController::class,"newSession"])
    ->name('admin.assignments.new-session') ;
    
    Route::get('reset',[AssignmentController::class,"reset"])
    ->name('admin.assignments.reset') ;
    }) ;
    


    Route::prefix("subjects")->group(function () {

      Route::get('create',[SubjectController::class,'create'])
      ->middleware(EnsureChoicePeriodIsNotActive::class)
      ->name("admin.subjects.create") ;

        Route::post('store',[SubjectController::class,'store'])
        ->middleware(EnsureChoicePeriodIsNotActive::class)
        ->name('admin.subjects.store') ;

        Route::put('{subject}',[SubjectController::class,'update'])
        ->name('admin.subjects.update') ;

        Route::delete('{subject}',[SubjectController::class,'destroy'])
        ->middleware(EnsureChoicePeriodIsNotActive::class)
        ->name('admin.subjects.destroy') ;
    
        Route::get('/{subject}/edit',[SubjectController::class,'edit'])
        ->name("admin.subjects.edit") ;
    
        Route::get('/',[SubjectController::class,'index'])
        ->name("admin.subjects.index") ;

        Route::get('export',[SubjectController::class,'export'])
        ->name("admin.subjects.export") ;
    
    }) ;
    
    
    Route::prefix("teams")->group(function () {
        
        Route::get('/',[TeamController::class,'index'])
        ->name("admin.teams.index") ;
        Route::get('create',[TeamController::class,'create'])
        ->name("admin.teams.create") ;
    
        Route::post('store',[TeamController::class,'store'])
        ->name('admin.teams.store') ;
          Route::get('/{team}/edit',[TeamController::class,'edit'])
        ->name("admin.teams.edit") ;  
        Route::put('{team}',[TeamController::class,'update'])
        ->name('admin.teams.update') ;
          Route::delete('delete-all',[TeamController::class,'destroyAll'])
        ->name('admin.teams.destroy-all') ;
    
        Route::delete('{team}',[TeamController::class,'destroy'])
        ->name('admin.teams.destroy') ;

      
       
        Route::get('export',[TeamController::class,'export'])
        ->name("admin.teams.export") ;
        Route::get('{team}',[TeamController::class,"show"])
        ->name('admin.teams.show') ;

    
    }) ;
    
    
    Route::prefix("choices")->group(function () {
        
        Route::get('/',[ChoiceController::class,'index'])
        ->name("choices.index") ;

        Route::get('create',[ChoiceController::class,'create'])
        ->name('admin.choices.create') ;

        Route::post('store',[ChoiceController::class,'store'])
        ->name('admin.choices.store') ;

   
        Route::put('{choice}',[ChoiceController::class,'update'])
        ->name('admin.choices.update') ;
    
        Route::get('/{choice}/edit',[ChoiceController::class,'edit'])
        ->name("admin.choices.edit") ;
    
        Route::delete('{choice}',[ChoiceController::class,'destroy'])
        ->name("admin.choices.destroy") ;

        Route::get('{choice}',[ChoiceController::class,'show'])
        ->name('admin.choices.show') ;

    
    }) ;
   
 

Route::prefix("students")->group(function ()  {
    Route::post("/upload",[StudentController::class,"upload"])
    ->name("admin.students.upload") ;
    Route::get("/upload",[StudentController::class,"uploadForm"])
    ->name("admin.students.uploadForm") ;

  
    Route::get("/{student}/edit",[StudentController::class,"edit"])
    ->name("admin.students.edit") ;
    Route::get("/{student}",[StudentController::class,"show"])
    ->name("admin.students.show") ;
    Route::post("destroy",[StudentController::class,"destroy"])
    ->name("admin.students.destroy") ;
    
    Route::get("/",[StudentController::class,"index"])
    ->name("admin.students.index") ;


}) ;

Route::prefix("specialities")->group(function () {

    Route::get("/",[SpecialityController::class,"index"])
    ->name("admin.specialities.index") ;
    Route::get("create",[SpecialityController::class,"create"])
    ->name("admin.specialities.create") ;
    
    Route::post("store",[SpecialityController::class,"store"])
    ->name("admin.specialities.store") ;

    Route::delete("{speciality}",[SpecialityController::class,"destroy"])
    ->name("admin.specialities.destroy") ;
}) ;

Route::prefix("emails-teacher")->group(function () {

    Route::get("/",[EmailTeacherController::class,"index"])
    ->name("admin.emails-teacher.index") ;
    Route::get("create",[EmailTeacherController::class,"create"])
    ->name("admin.emails-teacher.create") ;
    
    Route::post("store",[EmailTeacherController::class,"store"])
    ->name("admin.emails-teacher.store") ;

    Route::delete("{email}",[EmailTeacherController::class,"destroy"])
    ->name("admin.emails-teacher.destroy") ;

    Route::post("uploadEmails",[EmailTeacherController::class,"uploadEmails"])
    ->name("admin.emails-teacher.upload") ;

    Route::get("uploadEmails",[EmailTeacherController::class,"uploadForm"])
    ->name("admin.emails-teacher.upload-form") ;
    
}) ;


Route::prefix("important-dates")->group(function () {

    Route::get("/",[ImportantDateController::class,"index"])
    ->name("admin.important-dates.index") ;

   
    Route::get("edit",[ImportantDateController::class,"edit"])
    ->name("admin.important-dates.edit") ;
    Route::put("",[ImportantDateController::class,"update"])
    ->name("admin.important-dates.update") ;

}) ;

Route::prefix("teachers")->group(function () {


    Route::get("/",[TeacherController::class,"index"])
    ->name("admin.teachers.index") ;

   Route::get("{type}/create",[TeacherController::class,"create"])
   ->name('admin.teachers.create')->whereIn('type',[TeacherType::INTERNAL,TeacherType::EXTERNAL]) ;

   Route::get("{type}/{teacher}/edit",[TeacherController::class,"edit"])
   ->name('admin.teachers.edit')->whereIn('type',[TeacherType::INTERNAL,TeacherType::EXTERNAL]) ;

   Route::put("{type}/{teacher}",[TeacherController::class,"update"])
   ->name('admin.teachers.update')->whereIn('type',[TeacherType::INTERNAL,TeacherType::EXTERNAL]) ;
   
   Route::post("{type}/store",[TeacherController::class,"store"])
   ->name('admin.teachers.store')->whereIn('type',[TeacherType::INTERNAL,TeacherType::EXTERNAL]) ;

   Route::delete('{teacher}',[TeacherController::class,'destroy'])
   ->name('admin.teachers.destroy') ;

   Route::get('export',[TeacherController::class,'export'])
   ->name("admin.teachers.export") ;

   Route::get('{teacher}', [TeacherController::class, 'show'])
   ->name("admin.teachers.show");
}) ;
     
}) ;

