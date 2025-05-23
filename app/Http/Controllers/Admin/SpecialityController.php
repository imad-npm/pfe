<?php

namespace App\Http\Controllers\Admin;

use App\Models\Speciality;
use Illuminate\Http\Request;

class SpecialityController extends Controller
{
    //

    public function index() {
        
        $search=request()->input('search') ;

        if($search)
            $specialities=Speciality::where('abbreviation',$search)->paginate(10) ;
        else
        $specialities=Speciality::paginate(10) ;

        return view('admin.specialities.index',compact('specialities')) ;

    }

    public function create(){

        return view('admin.specialities.create') ;
    }

    public function store(Request $request){
        
        $validated=$request->validate([
            'abbreviation'=>["required","string","max:10",'unique:specialities,abbreviation'] 
        ]) ;
         $validated["abbreviation"]=strtoupper($validated["abbreviation"]) ;

        Speciality::create($validated) ;

        return back()->with('success',"Speciality created successfully") ;
    }

    public function destroy(Speciality $speciality)  {
        $speciality->delete() ;
        return back()->with('success',"Speciality deleted successfully") ;

    }

}

