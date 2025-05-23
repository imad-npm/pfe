<?php

namespace App\Models;

use App\Models\EmailStudent;
use App\Models\Team;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    public function getFullNameAttribute()  {
        return $this->firstname .' '. $this->lastname ;     
    }
    
 public function getEmailAttribute()  {
    return $this->getRelationValue("email")->email ?? "" ;
 }
    public function email() {
        return $this->hasOne(EmailStudent::class,"student_id") ;
    }
    public function teamAsFirst() {
        return $this->hasOne(Team::class,"student1_id") ;
    }
    public function teamAsSecond() {
        return $this->hasOne(Team::class,"student2_id") ;
    }
    public function speciality(){
        return $this->belongsTo(Speciality::class,"speciality_id") ;

    } 
}
