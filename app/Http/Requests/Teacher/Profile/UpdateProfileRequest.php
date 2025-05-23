<?php

namespace App\Http\Requests\Teacher\Profile;

use App\Models\Teacher;
use App\Rules\Name;
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
        return [
            'firstname' => ['required', 'string','min:3' , 'max:50',new Name()],
            'lastname' => ['required', 'string', 'min:3' ,'max:50',new Name()],
            'rank' => ['required', 'string', 'max:50'],
            'password' => ['nullable', 'confirmed', Password::defaults()],


        ];
    }
}
