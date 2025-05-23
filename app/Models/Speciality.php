<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Speciality extends Model
{
    //
    use HasFactory ;
    protected $guarded=[] ;

    public function students()  {
        return $this->hasMany(Student::class,"speciality_id");
    }
    public function subjectsAsFirst()  {
        return $this->hasMany(Subject::class,"speciality1_id");
    }
    public function subjectsAsSecond()  {
        return $this->hasMany(Subject::class,"speciality2_id");
    }
    public function subjectsAsThird()  {
        return $this->hasMany(Subject::class,"speciality3_id");
    }
    public function teams()  {
        return $this->hasMany(Team::class,"speciality_id");
    }
}
