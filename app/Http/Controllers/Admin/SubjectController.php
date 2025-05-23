<?php
namespace App\Http\Controllers\Admin;

use App\Models\Speciality;

use App\Http\Requests\Admin\Subject\CreateSubjectRequest;
use App\Http\Requests\Admin\Subject\UpdateSubjectRequest;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Models\SubjectIaa;
use Illuminate\Http\Request;
use App\Models\Teacher ;
use App\Models\Team;
use App\Services\SubjectService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

//use App\Models\Subject 


class SubjectController extends Controller
{
    //

    protected $subjectService ;

    public function __construct(SubjectService $service) {
        $this->subjectService = $service;
    }

    public function index(Request $request){
        $search=$request->input('search') ;
        $status=$request->input('status') ;
        $speciality=$request->input('speciality') ;


        if($speciality && !Speciality::where("abbreviation",$speciality)->first())
        return abort(404) ;

        $subjects=$this->subjectService->getSubjects($search,$status,$speciality) ;
  
       
        $specialities=Speciality::all(["id","abbreviation"]) ;
        return view("admin.subjects.index",compact('subjects','speciality',
        "specialities")) ;
    }
    public function create(){
        $specialities = Speciality::pluck("abbreviation","id")->toArray();
        $teachers=Teacher::all(['id','firstname','lastname']) ;
        
        $options= $this->subjectService->getTeacherOptions() ;

        return view("admin.subjects.form",compact('specialities',"options")) ;
    }

    public function edit(Subject $subject){
     
        $specialities = Speciality::pluck("abbreviation","id")->toArray();
        $teachers=Teacher::all() ;
        $options= $this->subjectService->getTeacherOptions() ;
        return view("admin.subjects.form",compact('subject','specialities',"options")) ;
    } 

    public function store(CreateSubjectRequest $request){
     //   $request->merge(["title"=>trim($request->input("title"))]) ;
        $validated=$request->validated() ;
        $supervisor=Teacher::find($validated["supervisor_id"]) ;
        $coSupervisor=null ;

        if($validated["co_supervisor_id"])
            $coSupervisor=Teacher::find($validated["co_supervisor_id"]) ;

            if($coSupervisor && $supervisor->type =="external" && $coSupervisor->type=="external"){
                return redirect()->back()->withErrors('supervisor and co-supervisor cannot be both external ') ;
            } 
              

        $subject=Subject::create($validated) ;

       
     return redirect()->back()->with("success", "Subject created successfully.");

  
    }
    public function show($id){

        return view("subjects.show") ;
    }


    public function update(UpdateSubjectRequest $request,Subject $subject){

       // $request->merge(["title"=>trim($request->input("title"))]) ;
        $validated=$request->validated() ;
     
        $supervisor=Teacher::find($validated["supervisor_id"]) ;
        $coSupervisor=null ;

        if($validated["co_supervisor_id"])
            $coSupervisor=Teacher::find($validated["co_supervisor_id"]) ;
   
        if($coSupervisor && $supervisor->type =="external" && $coSupervisor->type=="external"){
            return redirect()->back()->withErrors('supervisor and co-supervisor cannot be both external ') ;
            } 
        
            $subject->fill($validated) ;

            if(!$subject->isDirty())
                return redirect()->back() ;
            
            $subject->save() ;

      
    //    $this->subjectService->saveSpecialities($subject,$validated) ;

           
            return redirect()->back()->with("success", "Subject updated successfully.");

    }
    public function destroy(Subject $subject){
        $subject->delete() ;
        return redirect()->back()->with("success", "Subject deleted successfully.");

    } 
    public function destroyAll(){
        Subject::query()->delete()  ;
        return redirect()->back()->with("success", "All Subjects have been deleted successfully.");

    }

    public function export(Request $request)
    {
        ob_end_clean();
        $search=$request->input('search') ;
        $status=$request->input('status') ;
        $speciality=$request->input('speciality') ;


       

        $subjects=$this->subjectService->getSubjects($search,$status,$speciality,paginated:false) ;
          $zipFileName = $this->subjectService->createSubjectsZip($subjects);
        return response()->download($zipFileName)->deleteFileAfterSend();
    }
   
}
