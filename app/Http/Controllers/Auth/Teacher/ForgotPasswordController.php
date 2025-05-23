<?php

namespace App\Http\Controllers\Auth\Teacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str ;
use  App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;

class ForgotPasswordController extends Controller
{
    //
    public function showEmailForm() {
        return view("auth.teachers.email-form") ;
    }

    public function sendResetEmail(Request $request){

        try {
            //code...
            $request->validate([
                "email"=>"required|email|exists:teachers,email" 
            ]) ;
            $email=$request->email ;   
            $token=Str::random(10) ;
            DB::table("password_reset_tokens")->updateOrInsert(["email"=>$email]
            ,["token"=>$token,"created_at"=>now()]) ;
    
            $link=url("teacher/reset-password/$token") ;
            try {
                //code...
            Notification::route('mail',$email)
            ->notify(new ResetPasswordNotification($link))
             ;
            } catch (\Throwable $th) {
                return redirect()->back()->withErrors('An error 
                occurred while sending email. Please try again later.') ;
    
            }
            
            return back()->withInput()->with("success","email sent successfully") ;
     
        } catch (\Illuminate\Validation\ValidationException   $e) { 
                return back()->withErrors($e->validator)->withInput() ;
        }
        catch(\Exception $e){
            return back()->withInput()->with("error","error sending email") ;

        }

    
        }





    }

