<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UsernameRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!preg_match("/^[a-zA-Z0-9]+([_-][a-zA-Z0-9]+)*$/",$value))
        $fail('The username may only contain letters, numbers, dashes 
    and underscores.and separators must be between characters.') ;
    }
}
