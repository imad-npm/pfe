<?php


use App\Http\Controllers\Auth\Admin\AuthController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix("admin")
     ->middleware(['guest:admin', 'guest:team', 'guest:teacher'])
     ->group(function () {
          Route::get("register", [AuthController::class, "showRegisterForm"]);
          Route::post("register", [AuthController::class, "register"])
               ->middleware('throttle:register')
               ->name("admin.register");
          Route::get("login", [AuthController::class, "showLoginForm"])
               ->name("admin.login.form");

          Route::post("login", [AuthController::class, "login"])
          ->middleware('throttle:login')
               ->middleware("throttle:10,5")
               ->name("admin.login");
     });


Route::prefix("admin")->middleware('auth:admin')->group(function () {

     Route::get("logout", [AuthController::class, "logout"])
          ->name("admin.logout");
});
