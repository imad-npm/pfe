<?php

namespace App\Http\Controllers\Auth\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use  App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    //
    public function showResetForm($token){
        return view("auth.teachers.reset-password",compact('token')) ;
    }

    public function resetPassword(Request $request){

        $request->validate([
            "token"=>"required" ,
            "email" =>"email|exists:teachers,email" ,
            "password"=>"required|min:8|max:10|confirmed"
            ]) ;
        $record =DB::table("password_reset_tokens")->where(["token"=>$request->token,
        "email"=>$request->email])->first() ;    

        if($record){
            if($record->created_at < now()->subHour())
                return back()->with("error","token expired") ;
            Teacher::where(["email"=>$request->email])->
            update(["password"=>Hash::make($request->password)]) ;
            DB::table("password_reset_tokens")->where(["token"=>$request->token,
            "email"=>$request->email])->delete() ;

            return redirect()->route('teacher.login') ;
        }

        return back()->with("error","invalid email or token") ;

    }
}
