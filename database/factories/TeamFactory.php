<?php
namespace Database\Factories;
use App\Models\Speciality;


use App\Models\Student\StudentSid;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $speciality=Speciality::SID ;
        /*$ids=DB::table("students_$speciality")->pluck('id') ;
        $randomId=fake()->randomElement($ids) ;*/
        do {
            # code...    
            sleep(1) ;
            $student=StudentSid::with("email")->inRandomOrder()->first() ;

        } while (Team::where('student1_id',$student->id)->exists());
       
        return [
            //
            'student1_id'=>$student->id,
            'student1_email'=>$student->email,
            "speciality"=>$speciality,
            "max_average"=>$student->average ,
            "username"=> $student->email ,
            "password"=>Hash::make($student->email) ,
            "student1_email_verified_at"=>now()

        ];
    }
}
