<?php

namespace Database\Seeders;

use App\Models\Speciality;

use App\Models\Choice;
use App\Models\Subject;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $specialities = Speciality::all();
        foreach ($specialities as $speciality) {
            # code...
            $teams = Team::doesntHave("choice")->where("speciality_id", $speciality->id)
                ->inRandomOrder()->get();
            $subjects = Subject::where("speciality1_id", $speciality->id)
                ->orWhere("speciality2_id", $speciality->id)
                ->orWhere("speciality3_id", $speciality->id)->orderBy("id")
                ->pluck('id');
            foreach ($teams as $team) {
                # code...

                $arr = [

                    "team_id" =>  $team->id
                ];
                for ($i = 1; $i <= 10; $i++) {
                    $arr["subject$i" . "_id"] = $subjects[$i - 1];
                }

                $records[] = $arr;
            }


            Choice::insert($records);
            $records = [];
        }
    }
}
