<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speciality;
use App\Constants\TeacherType;
use App\Http\Controllers\Controller;
use App\Models\ImportantDate;
use App\Models\Student;

use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Team;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {

        $subjectCount = Subject::count();
        $teamCount = Team::selectRaw("
        count(*) as total,
         sum(case when student2_id is not null then 1 else 0 end) as two_members,
         sum(case when student2_id is  null then 1 else 0 end) as one_member
        ")->first();
        $studentsCountBySpeciality = Speciality::withCount("students")->pluck("students_count", "abbreviation");
        $teamsCountBySpeciality = Speciality::withCount("teams")->pluck("teams_count", "abbreviation");
        
        $subjectsCountBySpeciality = Speciality::
       withCount(["subjectsAsFirst","subjectsAsSecond","subjectsAsThird"])
        ->get()->mapWithKeys(function ($spec)  {
            return [$spec->abbreviation=>$spec->subjects_as_first_count+
            $spec->subjects_as_second_count+$spec->subjects_as_third_count ] ;
        }) ;
 

        $data = [
            'students' => [
                'total' => Student::count(),
                'bySpeciality' => $studentsCountBySpeciality,
                "withTeam" => Student::whereHas("teamAsFirst")
                    ->orWhereHas('teamAsSecond')->count(),
                "withoutTeam" => Student::whereDoesntHave("teamAsFirst")
                    ->WhereDoesntHave('teamAsSecond')->count(),

            ],
            'subjects' => [
                'total' => Subject::count(),
                'bySpeciality' => $subjectsCountBySpeciality,

                'assigned' => Subject::where('is_assigned', true)->count(),
                'notAssigned' => Subject::where('is_assigned', null)->count(),

            ],
            'teachers' => [
                'total' => Teacher::count(),
                'internal' => Teacher::where("type", TeacherType::INTERNAL)->count(),
                'external' => Teacher::where("type", TeacherType::EXTERNAL)->count(),
            ],
            'teams' => [
                'total' => Team::count(),
                'bySpeciality' => $teamsCountBySpeciality,
                'assigned' => Team::whereHas('assignedSubject')->count(),
                'notAssigned' => Team::whereDoesntHave('assignedSubject')->count(),
                "oneMember" => Team::whereDoesntHave('student2')->count(),
                "twoMember" => Team::whereHas('student2')->count(),

            ],
            "importantDates" => [
                "proposal" => ImportantDate::where('type', "proposal")->first(),
                "choice" => ImportantDate::where('type', "choice")->first(),

            ],
            "specialities"=>Speciality::all()
        ];
        return view('admin.dashboard', $data );
    }
}
