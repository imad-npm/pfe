<?php

namespace App\Rules;

use App\Models\ExternalTeacher;
use App\Models\Teacher;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TeacherExists implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $exists=Teacher::where('id',$value)->exists() ||
         ExternalTeacher::where('id',$value)->exists()  ;

         if( ! $exists)
         $fail(__('The selected teacher is invalid.')) ;
         
    }
}
