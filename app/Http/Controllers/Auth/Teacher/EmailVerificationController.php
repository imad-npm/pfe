<?php

namespace App\Http\Controllers\Auth\Teacher;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\Controller;
use App\Models\PendingTeacher ;
use App\Models\Teacher ;

use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    //
    public function notice(PendingTeacher $pendingTeacher) {
    //    if(Auth::check() && !Auth::user()->hasVerifiedEmail())
        return view("auth.teachers.email-notice",compact('pendingTeacher')) ;
    }
 
    public function verify(Request $request ,$id,$hash){
        
        $pendingTeacher=PendingTeacher::find($id) ;

        if (!URL::hasValidSignature($request))
            abort(403,"Invalid or Expired Link") ;
        
        if(!$pendingTeacher){
            abort(404,"Teacher not found ") ;
        }
        $email= $pendingTeacher->email  ;
      
        if(sha1($email)!=$hash){
            abort(404,"Invalid Link") ;
        }
        //$teacher=$request->user() ;

        $pendingTeacher->markEmailAsVerified() ;
       
        if($pendingTeacher->hasVerifiedEmail()){ 
            $data=$pendingTeacher->toArray() ;
            $data["id"]=null ;
            $teacher=Teacher::create($data) ;
           
            Auth::guard('teacher')->login($teacher) ; 
            
            $pendingTeacher->delete() ;
        return redirect()->route("teacher.dashboard") ;
        }

        return view("teachers.confirmation-status") ;
    }

    public function resend(PendingTeacher $pendingTeacher) {
      
        if($pendingTeacher->hasVerifiedEmail())
            return redirect()->route('teacher.dashboard');

            try {
                //code...
                $pendingTeacher->sendEmailVerificationNotification() ;

            } catch (\Throwable $th) {
                return redirect()->back()->withErrors('An error 
                occurred while sending email. Please try again later.') ;
            }
        return redirect()->back()->with("success", "Email has been sent successfully.");

    }
}
