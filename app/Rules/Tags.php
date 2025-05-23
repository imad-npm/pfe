<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Tags implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (!preg_match('/^([a-zA-Z0-9 _-]+)(\s*,\s*[a-zA-Z0-9 _-]+)*$/', $value)) 
            $fail("Invalid $attribute format. Use letters,
         numbers, spaces, underscores, or hyphens.Examples: 
         web-dev,machine_learning,data science,ai") ;
    }
}
