<?php

namespace App\Http\Controllers\Teacher;

use App\Constants\TeacherType;
use App\Http\Requests\Teacher\ExternalTeacher\CreateExternalTeacherRequest;
use App\Http\Requests\Teacher\ExternalTeacher\UpdateExternalTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    private $teacherService ;
    private $teacher ;

    public function __construct(TeacherService $service) {
        $this->teacherService=$service;
        $this->teacher=auth("teacher")->user() ;
    }
 
    public function index(Request $request){
        $search=$request->input('search') ;
        $teachers=$this->teacherService->getTeachers($search,$this->teacher->id) ;
        return view('teacher.teachers.index',compact('teachers')) ;
        
    }
    public function create()
    {
       
        return view('teacher.teachers.form');
    }

    public function edit( Teacher $teacher)
    {
       Gate::authorize('update',$teacher)  ;
          

        return view('teacher.teachers.form', compact('teacher'));
    }

    public function store(CreateExternalTeacherRequest $request)
    {

        $validated = $request->validated();
    
        $validated["type"] = TeacherType::EXTERNAL ;
        $validated["added_by_id"]=auth('teacher')->user()->id ;

        Teacher::create($validated);
        return redirect()->back()->with("success", "Teacher created successfully.");

    }

    public function update(UpdateExternalTeacherRequest $request, Teacher $teacher)
    {
        Gate::authorize('update',$teacher) ;

        $validated = $request->validated();

        $validated["type"] =TeacherType::EXTERNAL ;
        $validated["added_by_id"]=auth('teacher')->user()->id ;

        $teacher->update($validated);
        return redirect()->back()->with("success", "Teacher updated successfully.");

    }

    public function destroy(Teacher $teacher)  {

        Gate::authorize('delete',$teacher)  ;

        $teacher->delete() ;
        return redirect()->back()->with("success", "Teacher deleted successfully.");
    }

    
   
}
