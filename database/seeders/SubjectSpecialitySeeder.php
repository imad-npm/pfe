<?php
namespace Database\Seeders;

use App\Models\Speciality;


use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSpecialitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $specialities = Speciality::all();
        $subjects_ids=Subject::pluck('id')->toArray() ;

        foreach ($subjects_ids as $id) {
            # code...
            DB::table("subjects_specialities")->insert([
                'subject_id'=>$id ,
                "speciality1"=>fake()->randomElement($specialities) ,
  
            ]) ;
        }
        
    }
}
