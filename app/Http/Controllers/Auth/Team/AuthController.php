<?php

namespace App\Http\Controllers\Auth\Team;

use App\Http\Requests\Auth\Team\RegisterRequest;
use App\Http\Requests\Auth\Team\LoginRequest;

use App\Models\Team;
use App\Models\PendingTeam;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use  App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Services\TeamService;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    private $teamService ;

    public function __construct(TeamService $service) {
        $this->teamService = $service;
    }

    public function showLoginForm(){

        return view("auth.teams.login") ;
    }
    public function showRegisterForm(){
        $specialities=Speciality::pluck("abbreviation",'id')->toArray() ;
        return view("auth.teams.register",compact("specialities")) ;

    }
    public function register(RegisterRequest $request){

        $validated=$request->validated() ;
      //  $validated= $this->teamService->validateTeam($validated) ;
        $validated=$this->teamService->prepareTeamData($validated);
        PendingTeam::where('created_at',"<",Carbon::now()->subHour())->delete() ;
        $team=PendingTeam::create($validated)->fresh() ;
       // session()->put('pending_team',$team) ;
       try {
        //code...
      $team->sendEmailVerificationNotification() ;

    } catch (\Throwable $th) {
        return redirect()->back()->withErrors('An error 
        occurred while sending email. Please try again later.') ;
    }
       
       // Auth::guard('team')->login($team) ;
        return redirect()->route("team.verification.notice",$team);
    }

    public function login(LoginRequest $request) {
       
        $validated=$request->validated() ;
        $remember=$request->input('remember') ;
        if(Auth::guard('team')->attempt($validated,$remember) ){
           
            return redirect()->route("team.dashboard") ;
        
        }
        return back()->withErrors("invalid username or password") ;
    }

    public function logout(){
        Auth::guard("team")->logout() ;
      
        return redirect()->route("team.login.form") ;
    }
}
