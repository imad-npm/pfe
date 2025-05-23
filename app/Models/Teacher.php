<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Teacher\TeacherVerification;

class Teacher  extends Authenticatable implements MustVerifyEmail
{
    //
    use HasFactory, Notifiable;

    protected $guarded=[] ;

    

    public function getFullNameAttribute()  {
        return $this->firstname .' '. $this->lastname ;     
    }
    
    public function addedBy() {
        return 
        $this->belongsTo(Teacher::class,'added_by_id')  ;
    }
    
   
   public function sendEmailVerificationNotification(){
       // $this->email= $this->student1_email;
        $this->notify(new TeacherVerification() ) ;


   }
   public function markEmailAsVerified()
{
    
        $this->forceFill(['email_verified_at' => now()])->save();
   
}

public function hasVerifiedEmail(){
    return !is_null($this->email_verified_at)  ;
}


}
