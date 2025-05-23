<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Services\TeacherService;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    //
    private $teamService ;
    private $teacher ;

    public function __construct(TeamService $service) {
        $this->teamService=$service;
        $this->teacher=auth("teacher")->user() ;

    }
    public function show(Team $team)  {
        
        return view('teacher.teams.show',compact('team')) ;
    }
}
