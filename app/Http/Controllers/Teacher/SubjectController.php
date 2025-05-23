<?php
namespace App\Http\Controllers\Teacher;

use App\Models\Speciality;
use App\Constants\Specialty;
use App\Constants\TeacherType;
use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Subject\CreateSubjectRequest;
use App\Http\Requests\Admin\Subject\UpdateSubjectRequest;


use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Teacher ;
use App\Services\SubjectService;
use Illuminate\Support\Facades\Gate;

//use App\Models\Subject 


class SubjectController extends Controller
{
    //

    private $subjectService ;
    private $teacher ;

    public function __construct(SubjectService $service) {
        $this->subjectService=$service;
        $this->teacher=auth("teacher")->user() ;
    }

    public function index(Request $request){
        $search=$request->input('search') ;
        $speciality=$request->input('speciality') ;

        $search=$request->input('search') ;
        $status=$request->input('status') ;
        if($speciality && !Speciality::where("abbreviation",$speciality)->first())
        return abort(404) ;

       
        $subjects=$this->subjectService->getSubjects($search,$status,$speciality,$this->teacher) ;
        $specialities=Speciality::all() ;
        return view("teacher.subjects.index",compact('subjects','speciality',
        "specialities")) ;
        
    }
    public function create(){
        $specialities = Speciality::pluck("abbreviation","id")->toArray();
        $teachers=Teacher::all(['id','firstname','lastname']) ;
        
        $options= $this->subjectService->getTeacherOptions() ;
        
        return view("teacher.subjects.form",compact('specialities',"options")) ;
    }

    public function edit(Subject $subject){
    
        Gate::authorize('update',$subject) ;
            
       
        $specialities = Speciality::pluck("abbreviation","id")->toArray();
        $teachers=Teacher::all() ;
        $options= $this->subjectService->getTeacherOptions() ;
        return view("teacher.subjects.form",compact('subject','specialities',"options")) ;
    } 

    public function store(CreateSubjectRequest $request){
     //   $request->merge(["title"=>trim($request->input("title"))]) ;
        $validated=$request->validated() ;
        $supervisor=Teacher::find($validated["supervisor_id"]) ;
        $coSupervisor=null ;

        if($this->teacher->id != $validated["supervisor_id"]
        &&  $this->teacher->id != $validated["co_supervisor_id"]
        ){
            return redirect()->back()->withErrors('
            You need to be selected as a supervisor or co-supervisor  ') ;

        }
        if($validated["co_supervisor_id"])
            $coSupervisor=Teacher::find($validated["co_supervisor_id"]) ;

            if($coSupervisor && $supervisor->type ==TeacherType::EXTERNAL
             && $coSupervisor->type==TeacherType::EXTERNAL){
                return redirect()->back()->withErrors('supervisor and co-supervisor cannot be both external ') ;
            } 
              

     Subject::create($validated) ;

  
        return redirect()->back()->with("success", "Subject created successfully.");
  
    }
    public function show($id){

        return view("subjects.show") ;
    }


    public function update(UpdateSubjectRequest $request,Subject $subject){

        //$request->merge(["title"=>trim($request->input("title"))]) ;

        Gate::authorize('update',$subject) ;


        $validated=$request->validated() ;
     
        $supervisor=Teacher::find($validated["supervisor_id"]) ;
        $coSupervisor=null ;

        if($validated["co_supervisor_id"])
            $coSupervisor=Teacher::find($validated["co_supervisor_id"]) ;
   
        if($coSupervisor && $supervisor->type =="external" && $coSupervisor->type=="external"){
            return redirect()->back()->withErrors('supervisor and co-supervisor cannot be both external ') ;
            } 
        

        $subject->update($validated) ;
      
    //    $this->subjectService->saveSpecialities($subject,$validated) ;

           
    return redirect()->back()->with("success", "Subject updated successfully.");


    }

    public function destroy(Subject $subject)  {

        if(!Gate::authorize('delete',$subject))
            return abort(403) ;

        $subject->delete() ;
        return redirect()->back()->with("success", "Subject deleted successfully.");
    }
   


    

}
