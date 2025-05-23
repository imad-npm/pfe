<?php

namespace App\Http\Controllers\Admin;

use App\Constants\TeacherType;
use App\Http\Requests\Admin\Teacher\ExternalTeacherRequest;
use App\Http\Requests\Admin\Teacher\RegisterRequest;
use App\Http\Requests\Admin\Teacher\UpdateExternalTeacherRequest;
use App\Http\Requests\Admin\Teacher\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    private $teacherService ;

    public function __construct(TeacherService $service) {
        $this->teacherService = $service;
    }

    public function index(Request $request){
        $search=$request->input('search') ;
        $type=$request->input('type') ;
      
        $teachers= $this->teacherService->getTeachers($search,type:$type) ;
       
        
        return view('admin.teachers.index',compact('teachers')) ;
        
    }

    public function create($type)
    {
        $teacherType = $type;
        return view('admin.teachers.form', compact('teacherType'));
    }

    public function edit($type, Teacher $teacher)
    {
        $teacherType = $type;

        return view('admin.teachers.form', compact('teacherType', 'teacher'));
    }

    public function store(Request $request, $type)
    {

        if ($type == TeacherType::INTERNAL) {
            $rules = (new RegisterRequest())->rules();
        } else {
            $rules = (new ExternalTeacherRequest())->rules();
        }
        $validated = $request->validate($rules);
    
        $validated["type"] = $type;

        if ($type == TeacherType::INTERNAL) {
            $validated["email_verified_at"] = now();
            $validated["password"] = Hash::make($validated["password"]);
        }

        Teacher::create($validated);
        return redirect()->back()->with("success", "Teacher created successfully.");

    }

    public function update(Request $request, $type, Teacher $teacher)
    {
        $request->route()->setParameter('teacher',$teacher) ;
        if ($type == TeacherType::INTERNAL) {
            $rules = (new UpdateTeacherRequest($teacher))->rules();
        } else {
            $rules = (new UpdateExternalTeacherRequest($teacher))->rules();
        }
        $validated = $request->validate($rules);

        $validated["type"] = $type;

        if ($type == TeacherType::INTERNAL){

           if(isset($validated["password"])) {
            $validated["password"] = Hash::make($validated["password"]);
        } 
        else {
            unset($validated['password']) ;
        }
        } 
        
      

        $teacher->fill($validated) ;

        if(!$teacher->isDirty())
            return redirect()->back() ;
        
        $teacher->save() ;

        return redirect()->back()->with("success", "Teacher updated successfully.");

    }

    public function destroy(Teacher $teacher){
        $teacher->delete() ;
        return redirect()->back()->with("success", "Teacher deleted successfully.");

    }

    public function export(Request $request) {
        ob_end_clean() ;
        $status=$request->input('status') ;
    
        $zipFileName=$this->teacherService->createTeachersZip() ;    
        return response()->download($zipFileName)->deleteFileAfterSend() ;
        }

        public function show( Teacher $teacher)
        {
           
            return view('admin.teachers.show', compact('teacher'));
        }
}
