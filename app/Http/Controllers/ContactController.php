<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\Contact\ContactRequest;
use App\Notifications\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Controller ;

class ContactController extends Controller
{
    //
    public function submit(ContactRequest $request) {
        
        $validated=$request->validated() ;
        $email="contact@gmail.com" ;


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
