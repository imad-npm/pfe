<?php

namespace App\Http\Requests\Admin\Teacher;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Rules\Name;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'firstname' => ['required', 'string','min:3' , 'max:50',new Name()],
            'lastname' => ['required', 'string','min:3' , 'max:50',new Name()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',Rule::unique('teachers', 'email')
                  , Rule::exists('emails_teachers', 'email')],
            'rank' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
