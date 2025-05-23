<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests\Teacher\Contact\ContactRequest;
use App\Notifications\Teacher\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller ;

class ContactController extends Controller
{
    //
    public function show() {
        return view('teacher.contact-us') ;
    }

    public function submit(ContactRequest $request) {
        
        $validated=$request->validated() ;
        $email="contact@gmail.com" ;
        $teacher=auth('teacher')->user() ;
        $validated['name']=$teacher->fullName ;
        $validated['email']=$teacher->email ;

     
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
