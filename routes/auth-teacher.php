<?php


use App\Http\Controllers\Auth\Teacher\AuthController;
use App\Http\Controllers\Auth\Teacher\EmailController;
use App\Http\Controllers\Auth\Teacher\EmailVerificationController;
use App\Http\Controllers\Auth\Teacher\ForgotPasswordController;
use App\Http\Controllers\Auth\Teacher\ResetPasswordController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::prefix("teacher")
     ->middleware(['guest:admin', 'guest:team', 'guest:teacher'])
     ->group(function () {

          Route::get("forgot-password", [ForgotPasswordController::class, "showEmailForm"])
               ->name('teacher.forgot-password');

          Route::post("forgot-password", [ForgotPasswordController::class, "sendResetEmail"])
               ->middleware('throttle:reset-password')
               ->name("teacher.forgot-password.email");

          Route::get("reset-password/{token}", [ResetPasswordController::class, "showResetForm"]);

          Route::post("reset-password", [ResetPasswordController::class, "resetPassword"])
               ->name("teacher.reset-password");

          Route::get("register", [AuthController::class, "showRegisterForm"]);
          Route::post("register", [AuthController::class, "register"])
               ->middleware('throttle:register')
               ->name("teacher.register");
          Route::get("login", [AuthController::class, "showLoginForm"])
               ->name("teacher.login.form");

          Route::post("login", [AuthController::class, "login"])
               ->middleware('throttle:login')
               ->name("teacher.login");


          Route::get("email/verify/{pendingTeacher}", [EmailVerificationController::class, "notice"])
               ->name("teacher.verification.notice");

          Route::get(
               "email/verify/resend/{pendingTeacher}",
               [EmailVerificationController::class, "resend"]
          )
          ->middleware('throttle:resend-email')
               ->name("teacher.verification.resend");

          Route::get("email/verify/{id}/{hash}", [EmailVerificationController::class, "verify"])
               ->name("teacher.verification.verify");
     });


Route::prefix("teacher")->middleware('auth:teacher')->group(function () {


     Route::get("logout", [AuthController::class, "logout"])
          ->name("teacher.logout");
});
