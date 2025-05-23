<?php

namespace App\Http\Controllers\Auth\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str ;
use  App\Http\Controllers\Controller;
use App\Notifications\ResetPasswordNotification;
use App\Rules\EmailInTeam;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rule;

class ForgotPasswordController extends Controller
{
    //
    public function showEmailForm() {
        return view("auth.teams.email-form") ;
    }

    public function sendResetEmail(Request $request){

        
            $request->validate([
                "email"=>['required','email',
                new EmailInTeam] 
            ]) ;
            $email=$request->email ;   
            $token=Str::random(10) ;
            DB::table("password_reset_tokens")->updateOrInsert(["email"=>$email]
            ,["token"=>$token,"created_at"=>now()]) ;
    
            $link=url("team/reset-password/$token") ;
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
     
       

    
        }





    }

