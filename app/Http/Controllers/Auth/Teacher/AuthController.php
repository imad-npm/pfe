<?php

namespace App\Http\Controllers\Auth\Teacher;

use App\Http\Requests\Auth\Teacher\RegisterRequest;
use App\Http\Requests\Auth\Teacher\LoginRequest;

use App\Models\Teacher;
use App\Models\PendingTeacher;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use  App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function showLoginForm(){

        return view("auth.teachers.login") ;
    }
    public function showRegisterForm(){
        return view("auth.teachers.register") ;

    }
    public function register(RegisterRequest $request){
        //$email=$request->input('email') ;
       /* if(DB::table("pending_teachers")->where("email",$email)->exists() ){
            return redirect()->route("teachers.verification.notice");
        }*/

        $validated=$request->validated() ;
        $validated["password"]=Hash::make($validated["password"]) ;
        
      //  PendingTeacher::where('created_at',"<",Carbon::now()->subHour())->delete() ;
      //  $teacher=PendingTeacher::create($validated) ;
  
        $teacher=PendingTeacher::updateOrCreate([
            "email"=>$validated["email"]
        ],
            $validated
        );
    

        try {
            //code...
            $teacher->sendEmailVerificationNotification() ;
   
        } catch (\Throwable $th) {
            return redirect()->back()->withInput()->withErrors('An error 
            occurred while sending email. Please try again later.') ;
        }
       // Auth::guard('teacher')->login($teacher) ;
       
        return redirect()->route("teacher.verification.notice",$teacher->id);
    }

    public function login(LoginRequest $request) {
       
        $validated=$request->validated() ;
        $remember=$request->input('remember') ;
        if(Auth::guard('teacher')->attempt($validated,$remember) ){
            
            return redirect()->route("teacher.dashboard") ;
}
        return back()->withErrors("invalid username or password") ;
    }

    public function logout(){
  
        Auth::guard("teacher")->logout() ;
      
        return redirect()->route("teacher.login.form") ;
    }
}
