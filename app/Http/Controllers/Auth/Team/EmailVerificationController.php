<?php

namespace App\Http\Controllers\Auth\Team;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Http\Controllers\Controller;
use App\Models\PendingTeam ;
use App\Models\Team ;

use Illuminate\Support\Facades\URL;

class EmailVerificationController extends Controller
{
    //
    public function notice(PendingTeam $pendingTeam) {
    //    if(Auth::check() && !Auth::user()->hasVerifiedEmail())
        return view("auth.teams.email-notice",compact('pendingTeam')) ;
    }
 
    public function verify(Request $request ,$id,$student,$hash){
        
        $pendingTeam=PendingTeam::find($id) ;

        if (!URL::hasValidSignature($request))
            abort(403,"Invalid or Expired Link") ;
        
        if(!$pendingTeam){
            abort(404,"Team not found ") ;
        }
        $email=$student==1 ? $pendingTeam->student1_email :  $pendingTeam->student2_email ;
      
        if(sha1($email)!=$hash){
            abort(404,"Invalid Link") ;
        }
        //$team=$request->user() ;

        $pendingTeam->markStudentEmailAsVerified(intval($student)) ;
        
        if($pendingTeam->hasVerifiedEmail()){
            $data=$pendingTeam->toArray() ;
            $data['id']=null ;
            $team=Team::create($data) ;
            Auth::guard('team')->login($team) ;
           
            $pendingTeam->delete() ;
        return redirect()->route("team.dashboard") ;
        }

        return view("auth.teams.confirmation-status",compact("pendingTeam")) ;
    }

    public function resend(PendingTeam $pendingTeam) {
      
        if($pendingTeam->hasVerifiedEmail())
            return redirect()->back();

            try {
                //code...
                $pendingTeam->sendEmailVerificationNotification() ;

            } catch (\Throwable $th) {
                return redirect()->back()->withErrors('An error 
                occurred while sending email. Please try again later.') ;
            }

        return redirect()->back()->with("success", "Email has been sent successfully.");

    }
}
