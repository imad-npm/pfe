<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportantDate\ImportantDateRequest;
use App\Models\ImportantDate;
use Illuminate\Http\Request;

class ImportantDateController extends Controller
{
    //

    public function index()  {
        $dates=ImportantDate::all() ;

        return view('admin.important-dates.index',compact("dates")) ;

    }

    public function edit()  {

        $choiceDate=ImportantDate::where('type','choice')->first() ;
        $proposalDate=ImportantDate::where('type','proposal')->first() ;
        return view("admin.important-dates.edit",compact("choiceDate","proposalDate")) ;
    }

    public function update(ImportantDateRequest $request) {
        $validated=$request->validated() ;
        
            ImportantDate::updateOrCreate(
                ['type'=>$validated["type"]
            ],
                [
                "start"=>$validated["start"] ,
                "end"=>$validated["end"] 
                ]
            ) ;  
       


        return redirect()->back()->with("success", "Dates updated successfully.");

      
    }
}
