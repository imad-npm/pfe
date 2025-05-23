<?php

namespace App\Http\Controllers\Team;

use App\Http\Controllers\Controller;

use App\Http\Requests\Team\Choice\ChoiceRequest;
use App\Http\Requests\Team\Profile\UpdateProfileRequest ;
use App\Models\Subject;
use App\Models\Choice;
use App\Models\ImportantDate;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    //
  private $team ;

    public function __construct() {
      $this->team = auth('team')->user() ;
      ;
    }


    public function index(){
      $choiceDate = ImportantDate::where('type', 'choice')->first();

      $team=Team::with("assignedSubject")->find($this->team->id) ;
    return view('team.dashboard',compact('team',"choiceDate")) ;

    }

   public function editProfile()  {
    $team=$this->team ;

     return view('team.edit-profile',compact('team')) ;

   }

   public function updateProfile(UpdateProfileRequest $request){

    $validated=$request->validated() ;

    if($validated["password"]){
      $validated['password']= Hash::make($validated['password'] ) ;
    }
    else
    unset($validated['password']) ;

    $this->team->fill($validated) ;

    if(!$this->team->isDirty())
    return redirect()->back() ;
    
    $this->team->save() ;
    
    return redirect()->back()->with("success", "Profile updated successfully.");

  }
  public function destroyProfile(){

    
    $this->team->delete();
    return redirect()->back() ; 
  
  }

/*
  public function result(){

    $team=Team::with('assignedSubject')->where('id',$this->team->id)->first() ;

    return view('team.result',compact('team')) ;
  }
 */

  
    


  
    
}
