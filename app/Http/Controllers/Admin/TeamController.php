<?php
namespace App\Http\Controllers\Admin;

use App\Models\Speciality;
use App\Http\Requests\Admin\Team\RegisterRequest;
use App\Http\Requests\Admin\Team\UpdateTeamRequest;
use App\Models\Team;
use App\Services\TeamService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use ZipArchive;

class TeamController extends Controller
{
    //
    private $teamService;

    public function __construct(TeamService $service)
    {
        $this->teamService = $service;
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $status=$request->input('status') ;
        $type=$request->input('type') ;
        $speciality=$request->input('speciality') ;
        $choice=$request->input('choice') ;
        $sort=$request->input('sort') ;

        if($speciality && !Speciality::where("abbreviation",$speciality)->first())
        return abort(404) ;

        $teams=$this->teamService->getTeams($search,
        $status,$speciality,$type,$choice,$sort) ;
       
        $specialities = Speciality::all();

        return view('admin.teams.index', compact('teams','speciality','specialities'));
    }
    public function create()
    {
        $specialities = Speciality::pluck("abbreviation","id")->toArray();

        return view('admin.teams.form',compact('specialities'));
    }

    public function edit(Team $team)
    {
        $specialities = Speciality::pluck("abbreviation","id")->toArray();

        return view('admin.teams.form', compact('team',"specialities"));
    }

    public function store(RegisterRequest $request)
    {

        $validated = $request->validated();
        $validated=$this->teamService->prepareTeamData($validated);
        $team=Team::create($validated);
        if($team->student1_email)
        $team->markStudentEmailAsVerified(1) ;
        if($team->student2_email)
        $team->markStudentEmailAsVerified(2) ;
        return redirect()->back()->with("success", "Team created successfully.");

    
    }

    public function update(UpdateTeamRequest $request, Team $team)
    {

        $validated = $request->validated();
       
        $validated=$this->teamService->prepareTeamData($validated,$team);
        $team->fill($validated) ;

        if(!$team->isDirty())
            return redirect()->back() ;

        
        $team->save() ;

        return redirect()->back()->with("success", "Team updated successfully.");

    }
    public function show(Team $team)  {
        
        return view('admin.teams.show',compact('team')) ;
    }

    public function destroy(Team $team){
        $team->delete() ;
        return redirect()->back()->with("success", "Team deleted successfully.");

    }
    public function destroyAll(){
        Team::query()->delete() ;
        return redirect()->back()->with("success", "All Teams have been deleted successfully.");

    }

    public function export(Request $request) {
    ob_end_clean() ;

    $status=$request->input('status') ;
    $search = $request->input('search');
    $status=$request->input('status') ;
    $type=$request->input('type') ;
    $speciality=$request->input('speciality') ;
    $choice=$request->input('choice') ;

    $sort=$request->input('sort') ;

    $teams=$this->teamService->getTeams($search,
    $status,$speciality,$type,$choice,$sort) ;

        $zipFileName=$this->teamService->createTeamsZip($teams) ;    
    return response()->download($zipFileName)->deleteFileAfterSend() ;
    }

}
