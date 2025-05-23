<?php

namespace App\Http\Controllers;

use App\Models\Speciality;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Services\SubjectService;


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

        $speciality=$request->input('speciality') ;

        if($speciality && !Speciality::where("abbreviation",$speciality)->first())
        return abort(404) ;

        $subjects=$this->subjectService->getSubjects(
            $search,speciality: $speciality,status:"not assigned") ;
        
        
       
        $specialities=Speciality::all(["id","abbreviation"]) ;
        if (auth('admin')->check()  || auth('team')->check() || auth('teacher')->check() )
  $layout='layouts.app';  
else
$layout='layouts.guest' ;


        return view("public.subjects.index",
        compact('subjects','speciality',"specialities",'layout')) ;
        
    }
  
    public function show(Subject $subject){
            
        $specialities=Speciality::all() ;
        if (auth('admin')->check()  || auth('team')->check() || auth('teacher')->check() )
        $layout='layouts.app';  
      else
      $layout='layouts.guest' ;
      

        return view("public.subjects.show",compact('subject',"specialities",'layout')) ;
    }

 
   
}
