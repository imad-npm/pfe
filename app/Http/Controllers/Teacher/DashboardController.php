<?php

namespace App\Http\Controllers\Teacher;

use App\Models\Speciality;

use App\Http\Controllers\Controller;

use App\Http\Requests\Team\Choice\ChoiceRequest;
use App\Http\Requests\Teacher\Profile\UpdateProfileRequest;
use App\Models\ImportantDate;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  //
  private $teacher;

  public function __construct()
  {
    $this->teacher = auth('teacher')->user();
  }

  public function index()
  {

    $teacher = $this->teacher;
    $proposalDate = ImportantDate::where('type', 'proposal')->first();
    $specialities=Speciality::all() ;

    foreach ($specialities as $speciality) {
      # code...
      $subjects[$speciality->abbreviation]=
      Subject::where(function ($q) use ($speciality) {
        $q->where('speciality1_id', $speciality->id)
          ->orWhere('speciality2_id', $speciality->id)
          ->orWhere('speciality3_id', $speciality->id) ;
        }) ->where(function ($q) {
          $q->where('supervisor_id', $this->teacher->id)
          ->orWhere('co_supervisor_id', $this->teacher->id);
  
        })->count() ;
    }
    
    $subjects ['total' ]= Subject::where('supervisor_id', $this->teacher->id)
        ->orWhere('co_supervisor_id', $this->teacher->id)->count();

     $subjects['assigned'] = Subject::where('is_assigned', true)
     ->where(function ($q) {
        $q->where('supervisor_id', $this->teacher->id)
        ->orWhere('co_supervisor_id', $this->teacher->id);

      })->count();

      $subjects['notAssigned'] = Subject::where('is_assigned', null)
      ->where(function ($q) {
        $q->where('supervisor_id', $this->teacher->id)
        ->orWhere('co_supervisor_id', $this->teacher->id) ;

      })->count()  ;
        
    
    return view('teacher.dashboard', compact('teacher', 'proposalDate', "subjects","specialities"));
  }

  public function editProfile()
  {
    $teacher = $this->teacher;

    return view('teacher.edit-profile', compact('teacher'));
  }

  public function updateProfile(UpdateProfileRequest $request)
  {

    $validated = $request->validated();
    if (!$validated["password"])
      $validated['password']=$this->teacher->password ;

      $this->teacher->update($validated);
    

    return redirect()->back()->with("success", "Profile updated successfully.");
  }

  public function destroyProfile()
  {
    $this->teacher->delete();
    return redirect()->back()->with("success", "Profile deleted successfully.");
  }
}
