<?php

namespace App\Http\Controllers\Admin;

use App\Models\Choice;
use App\Models\Subject;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Services\ChoiceService;

class AssignmentController extends Controller
{
    //
    private $choiceService ;

    public function __construct(ChoiceService $service) {
       $this->choiceService = $service;


   }
  
    public function assign() {
        $teams=Team::has("choice")->with("choice")->orderByDesc('max_average')->get() ;
        $subjects=Subject::whereNull("is_assigned")->get(['id']) ;
        $teamsToUpdate=[] ;
        $subjectsToUpdate=[] ;

        if(!$teams)
            return back()->withErrors("Teams Not Found") ;
        if(!$subjects)
            return back()->withErrors("Subjects Not Found") ;

        foreach ($teams as $team) {
            # code...
            $choice=$team->choice ;
            if(!$choice)
                continue ;
        $subjectIds=$this->choiceService->getSubjectIds($choice) ;
        
            foreach ($subjectIds as $id) {
                $subject=$subjects->firstWhere('id',$id) ;
                if(!$subject)
                    continue  ;
                if($subject->is_assigned)
                    continue ;
                   
                $team->assigned_subject= $id ;
                $subject->is_assigned=true ;
                $teamsToUpdate[]=[
                    'id'=>$team->id,
                    'student1_id'=>$team->student1_id ,
                    'student2_id'=>$team->student2_id ,
                    'student1_email'=>$team->student1_email ,
                    'student2_email'=>$team->student2_email ,
                    'student1_email_verified_at'=>$team->student1_email_verified_at ,
                    'student2_email_verified_at'=>$team->student2_email_verified_at ,
                     "assigned_subject"=>$id,
                     'speciality_id'=>$team->speciality_id ,
                     'username'=>$team->username , 
                     'password'=>$team->password ,
                     'max_average'=>$team->max_average ,

                    'created_at'=>$team->created_at ,
                    'updated_at'=>now() 
                   
                ] ;
                $subjectsToUpdate[]=$id ;
               // $subject->save() ;         
                      
             //   $team->save() ;
                break ;
            }  
           
    }
    Team::upsert($teamsToUpdate,'id',['assigned_subject']) ;
    Subject::whereIn('id',$subjectsToUpdate)->update(['is_assigned'=>true]) ;
    return back()->with('success', "Subject assignment completed successfully.");

}
  
public function reset() {
    Team::query()->update(['assigned_subject'=>null]) ;
    Subject::query()->update(['is_assigned'=>null]) ;

   return back()->with('success', "All assignments have been reset.");

}

      




public function newSession(){
    $ids=Team::whereDoesntHave('assignedSubject')->pluck('id') ;
    Choice::whereIn('team_id',$ids)->delete() ;

    return back()->with('success', "New session initialized. Unassigned team choices have been cleared.");
}
 
}