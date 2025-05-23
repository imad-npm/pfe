<?php

namespace App\Http\Requests\Admin\Teacher;

use App\Rules\Name;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateTeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    private $teacher; 

    public function __construct($teacher)
    {
        $this->teacher = $teacher;
    }
    

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
            'firstname' => ['required','min:3' , 'string', 'max:50',new Name()],
            'lastname' => ['required','min:3' , 'string', 'max:50',new Name()],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255',
            Rule::unique('teachers', 'email')->ignore($this->teacher->id)],
            'rank' => ['required', 'string', 'max:50'],
            'password' => ['nullable', 'confirmed', Password::defaults()],
        ];
    }
}
