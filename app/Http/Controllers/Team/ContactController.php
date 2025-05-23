<?php

namespace App\Http\Controllers\Team;

use App\Http\Requests\Team\Contact\ContactRequest;
use App\Notifications\Team\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller ;

class ContactController extends Controller
{
    //

    public function show() {
        return view('team.contact-us') ;
    }
    public function submit(ContactRequest $request) {
        
        $validated=$request->validated() ;
        $email="contact@gmail.com" ;
        $team=auth('team')->user() ;
        $validated['name1']=$team->student1->fullName ;
        $validated['email1']=$team->student1_email ;
        if($team->student2_id){
            $validated['name2']=$team->student2->fullName ;
            $validated['email2']=$team->student2_email ;
                
        }
        try {
            //code...
               Notification::route('mail',$email)
        ->notify(new ContactMessage($validated)) ;

        return redirect()->back()->with('success',"Your message has been sent!") ;
   
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors('An error occurred while sending your message. Please try again later.') ;

        }
      }
}
