<?php
namespace Database\Factories;
use App\Models\Speciality;


use App\Models\Choice;
use App\Models\Subject;
use App\Models\Team;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Choice>
 */
class ChoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $speciality=Speciality::SID ;
       sleep(1) ;
        $team=Team::doesntHave("choice")->inRandomOrder()->first() ;
        
        if(is_null($team)){
          return throw new Exception("stop") ;
          dd($team) ;
        }
      
        // 4 5 1   4 12 
       $subjects = Subject::
         where("speciality1",$speciality)
        ->orWhere("speciality2",$speciality)
        ->orWhere("speciality3",$speciality)->orderBy("id")->pluck('id') ;
       
        $arr=[
            "team_id"=>  $team->id
        ] ;
           
        for ($i=1; $i<=10 ; $i++) { 
            $arr["subject$i"."_id"]=$subjects[$i-1] ;
        }
        return $arr;
    }
}
