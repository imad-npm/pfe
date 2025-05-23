<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Choice\ChoiceRequest;
use App\Models\Subject;
use App\Models\Choice;
use App\Services\ChoiceService;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    //
    private $choiceService ;

     public function __construct(ChoiceService $service) {
        $this->choiceService = $service;

    }

    public function index(){

        $choices=Choice::with('team')->get() ;
    }

    public function create(Request $request){
        $teamId=$request->input('team_id') ;
   
        
        $options= $this->choiceService->getSubjectOptions($teamId) ;

        return view('admin.choices.form',compact('options','teamId')) ;
    }

    public function edit(Choice $choice){
        
        $teamId=$choice->team->id ;
        $options= $this->choiceService->getSubjectOptions($teamId) ;
       
        return view('admin.choices.form',compact('options',"choice","teamId")) ;
    }

    public function store(ChoiceRequest $request) {
        
        $validated =$request->validated() ;
        $selectedSubjects=[];
       foreach ($validated as $key => $value) {
        # code...
        if($key!="team_id")
            $selectedSubjects[]=$value ;
       }

        $hasDuplicates = count($selectedSubjects) > count(array_unique($selectedSubjects)); 
        if($hasDuplicates){
            return redirect()->back()->withInput()->withErrors("All subjects must be different",) ;

        }
        $validated["team_id"]=$request->input('team_id') ;
        Choice::create($validated) ;


        return redirect()->back()->with("success","Choice Created successfully.") ;
    }
    public function update(ChoiceRequest $request,Choice $choice) {
        
        $validated =$request->validated() ;
        $hasDuplicates = count($validated) > count(array_unique($validated)); 
        if($hasDuplicates){
            return redirect()->back()->withInput()->withErrors("All subjects must be different",) ;

        }
        
        $choice->fill($validated) ;

        if(!$choice->isDirty())
            return redirect()->back() ;
        
        $choice->save() ;

        return redirect()->back()->with("success","Choice Updated successfully.") ;
    }
    public function show(Choice $choice) {
        $subjects=$this->choiceService->getSubjects($choice) ;

        return view('admin.choices.show',compact('choice',"subjects")) ;
    }

    public function destroy(Choice $choice)  {
        $choice->delete() ;
        return redirect()->route('admin.teams.index') ;
    }

    
}
