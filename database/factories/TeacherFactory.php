<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Teacher>
 */
class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {        $grades=["MCA","MCB"] ;
    
        $emails=DB::table('emails_teachers')->pluck('email')->toArray() ;

        return [
           
            'firstname' => fake()->firstName(),
            'lastname' => fake()->lastName(),
            'rank' => fake()->randomElement($grades),
            "type"=>"internal" ,
            'email' => $emails[fake()->unique()->numberBetween(0,count($emails)-1) ],
            'password'=>Hash::make("password1") ,
            "email_verified_at"=>now()
        
        ];
    }
}
