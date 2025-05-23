
<?php

use App\Http\Controllers\Team\DashboardController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Team\ChoiceController;
use App\Http\Controllers\Team\ContactController;
use App\Http\Middleware\EnsureChoicePeriodIsActive;

 Route::prefix("team")->middleware('auth:team')->group(function () {

    Route::get('dashboard',[DashboardController::class,"index"])
    ->name('team.dashboard');

   /* Route::get('result',[DashboardController::class,"result"])
    ->name('team.result');
*/
   Route::put('update-profile',[DashboardController::class,"updateProfile"])
    ->name('team.profile.update');
  
    Route::get('edit-profile',[DashboardController::class,"editProfile"])
    ->name('team.profile');

    Route::delete('destroy-profile',[DashboardController::class,"destroyProfile"])
    ->name('team.profile.destroy');
   
    Route::prefix("contact")->group(function () {

      Route::post('submit', [ContactController::class, "submit"])
      ->middleware('throttle:contact')
      ->name('team.contact.submit');

      Route::get('', [ContactController::class, "show"])
      ->name('team.contact.show');
  }) ;

    Route::prefix("choices")->group(function () {
       Route::get('create',[ChoiceController::class,'create'])
       ->name("team.choices.create")->middleware(EnsureChoicePeriodIsActive::class) ;

       Route::get('show',[ChoiceController::class,'show'])
       ->name("team.choices.show") ;

      Route::post('store',[ChoiceController::class,'store'])
      ->name('team.choices.store')->middleware(EnsureChoicePeriodIsActive::class) ; ;
      
    });


 
 }) ;