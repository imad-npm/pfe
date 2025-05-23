<?php

namespace App\Http\Controllers\Auth\Team;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use  App\Http\Controllers\Controller;
use App\Models\Team;
use App\Rules\EmailInTeam;

class ResetPasswordController extends Controller
{
    //
    public function showResetForm($token){
        return view("auth.teams.reset-password",compact('token')) ;
    }

    public function resetPassword(Request $request){

        $request->validate([
            "token"=>"required" ,
            "email" =>['required','email',new EmailInTeam]
           ,
            "password"=>"required|min:8|max:10|confirmed"
            ]) ;
        $record =DB::table("password_reset_tokens")->where(["token"=>$request->token,
        "email"=>$request->email])->first() ;    

        if($record){
            if($record->created_at < now()->subHour())
                return back()->withErrors("token expired") ;
            Team::where(["student1_email"=>$request->email])
            ->orWhere(["student2_email"=>$request->email])
            ->update(["password"=>Hash::make($request->password)]) ;
            DB::table("password_reset_tokens")->where(["token"=>$request->token,
            "email"=>$request->email])->delete() ;

            return redirect()->route("team.login") ;
        }

        return back()->withErrors("invalid email or token") ;

    }
}
