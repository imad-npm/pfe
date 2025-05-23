<?php
namespace Database\Seeders;

use App\Models\Speciality;
use App\Models\Student;
use App\Models\Student\StudentIaa;
use App\Models\Student\StudentRsid;
use App\Models\Student\StudentSid;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    
    {
        $specialities=Speciality::all() ;
        foreach ($specialities as $speciality) {
            # code...
             $students=Student::with("email")->where("speciality_id",$speciality->id)
       
        ->inRandomOrder()->get() ;
       

        for ($i=0 ; $i<count($students)-1 ;$i+=2 ) {
            # code...
            $s1=$students[$i] ;
            $s2=$students[$i+1] ;
            $records[]=[
                //
                'student1_id'=>$s1->id,
                'student1_email'=>$s1->email,
                'student2_id'=>$s2->id,
                'student2_email'=>$s2->email,
                "speciality_id"=>$speciality->id,
                "max_average"=>max($s1->average,$s2->average) ,
                "username"=> $s1->email ,
                "password"=>Hash::make($s1->email) ,
                "student1_email_verified_at"=>now() ,
                "student2_email_verified_at"=>now()

            ] ;
        }
        
        //
        Team::insert($records) ;
        $records=[] ;
        }
       
    }
}
