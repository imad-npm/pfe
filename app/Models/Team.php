<?php
namespace App\Models;


use App\Models\Student;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Team\TeamVerification;
//use Illuminate\Support\Facade\Notification ;

class Team extends Authenticatable implements MustVerifyEmail
{
    //
    use HasFactory, Notifiable;

//    protected $fillables=["student1_email,student2_email"] ;
    protected $guarded=[] ;

    
    public function choice() {
        return $this->hasOne(Choice::class,"team_id") ;
    }

    public function assignedSubject(){
        return $this->belongsTo(Subject::class,"assigned_subject") ;
    }
    public function student1() {
        return $this->belongsTo(Student::class,"student1_id") ;

    }
    
    public function student2() {
        return $this->belongsTo(Student::class,"student2_id") ;

    }
    public function speciality(){
        return $this->belongsTo(Speciality::class,"speciality_id") ;

    } 

    public $email ;

    public function getEmailForVerification(){

        return $this->email ;
    }                            

    public function sendEmailVerificationNotification(){
        
        
        if(!$this->student1_email_verified_at){
        $this->email= $this->student1_email;
        $this->notify(new TeamVerification(1) ) ;

        }
        if($this->student2_email && !$this->student2_email_verified_at){
            $this->email= $this->student2_email;
            $this->notify(new TeamVerification(2) ) ;
        }

   }
   public function markStudentEmailAsVerified($type)
{
    if ($type==1) {
        $this->forceFill(['student1_email_verified_at' => now()])->save();
    }

    if ($type==2) {
        $this->forceFill(['student2_email_verified_at' => now()])->save();
    }
}

public function hasVerifiedEmail(){
    return !is_null($this->student1_email_verified_at) 
    && (is_null($this->student2_email) || !is_null($this->student2_email_verified_at));

}

public function hasAllVerifiedEmail(){

    return !is_null($this->student1_email_verified_at) 
    && (is_null($this->student2_email) || !is_null($this->student2_email_verified_at));

}


}
