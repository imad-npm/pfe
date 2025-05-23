<?php

namespace App\Rules;

use App\Models\Team;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailInTeam implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $exists=Team::where("student1_email",$value)
        ->orWhere("student2_email",$value)
        ->exists() ;

        if(!$exists)
            $fail("Email Doesn't Exist") ;
    }
}
