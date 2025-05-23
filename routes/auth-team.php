<?php

use App\Http\Controllers\Auth\Team\AdminAuthController;
use App\Http\Controllers\Auth\Team\AdminController;
use App\Http\Controllers\Auth\Team\AuthController;
use App\Http\Controllers\Auth\Team\EmailController;
use App\Http\Controllers\Auth\Team\EmailVerificationController;
use App\Http\Controllers\Auth\Team\ForgotPasswordController;
use App\Http\Controllers\Auth\Team\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix("team")
     ->middleware(['guest:admin', 'guest:team', 'guest:teacher'])
     ->group(function () {

          Route::get("forgot-password", [ForgotPasswordController::class, "showEmailForm"])
               ->name('team.forgot-password');

          Route::post("forgot-password", [ForgotPasswordController::class, "sendResetEmail"])
               ->middleware('throttle:reset-password')
               ->name("team.forgot-password.email");

          Route::get("reset-password/{token}", [ResetPasswordController::class, "showResetForm"]);
          Route::post("reset-password", [ResetPasswordController::class, "resetPassword"])
               ->name("team.reset-password");

          Route::get("register", [AuthController::class, "showRegisterForm"]);

          Route::post("register", [AuthController::class, "register"])
               ->middleware('throttle:register')
               ->name("team.register");

          Route::get("login", [AuthController::class, "showLoginForm"])
               ->name("team.login.form");

          Route::post("login", [AuthController::class, "login"])
               ->middleware('throttle:register')
               ->name("team.login");


          Route::get("email/verify/{pendingTeam}", [EmailVerificationController::class, "notice"])
               ->name("team.verification.notice");

          Route::get("email/verify/{id}/{student}/{hash}", [EmailVerificationController::class, "verify"])
               ->name("team.verification.verify");

          Route::get("email/verify/resend/{pendingTeam}", [EmailVerificationController::class, "resend"])
               ->middleware('throttle:resend-email')
               ->name("team.verification.resend");
     });


Route::prefix("team")->middleware('auth:team')->group(function () {


     Route::get("logout", [AuthController::class, "logout"])
          ->name("team.logout");
});
