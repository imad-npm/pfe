<?php

namespace App\Http\Requests\Team\Profile;

use App\Models\Team;
use App\Models\User;
use App\Rules\UsernameRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $team =auth('team')->user() ;
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'min:3' ,
                new UsernameRule,
                Rule::unique(Team::class,'username')->ignore($team->id),
            ],
            'password' => ['nullable','confirmed', Password::defaults()],

        ];
    }
}
