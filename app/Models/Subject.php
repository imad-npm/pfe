<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    //
    use HasFactory ;
    protected $guarded=[] ;


    public function supervisor()  {
       return $this->belongsTo(Teacher::class,'supervisor_id') ; 
    
    }

    public function coSupervisor()  {
        return $this->belongsTo(Teacher::class,'co_supervisor_id') ; 
    
    }
    public function team(){
        return $this->hasOne(Team::class,"assigned_subject") ;

    }
    public function speciality1(){
        return $this->belongsTo(Speciality::class,"speciality1_id") ;

    } 
    public function speciality2(){
        return $this->belongsTo(Speciality::class,"speciality2_id") ;

    }   public function speciality3(){
        return $this->belongsTo(Speciality::class,"speciality3_id") ;

    } 
   
}


