<?php
namespace Database\Factories;
use App\Models\Speciality;


use App\Models\Teacher;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    { $specialities = Speciality::pluck("id")->toArray();
        $teacher_ids=Teacher::pluck('id')->toArray() ;
        $tags=['ai', 'web', 'mobile', 'cloud', 'security', 'devops'] ;

        return [
            //
            'title' => fake()->realText(100),
            'description' => fake()->realText(500),
            'supervisor_id' => fake()->randomElement($teacher_ids),
            'co_supervisor_id' => fake()->randomElement($teacher_ids),
            'speciality1_id'=>fake()->randomElement($specialities) , 
            'tags'=>implode(',' ,fake()-> randomElements($tags,rand(2,4)) ) 


        ];
    }
}
