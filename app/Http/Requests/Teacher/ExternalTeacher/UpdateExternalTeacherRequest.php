<?php

namespace App\Http\Requests\Teacher\ExternalTeacher;

use App\Http\Requests\Admin\Teacher\UpdateExternalTeacherRequest as AdminUpdateExternalTeacherRequest;
use App\Rules\Name;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UpdateExternalTeacherRequest extends FormRequest
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
            //
            'firstname' => ['required', 'string','min:3' , 'max:50',new Name()],
            'lastname' => ['required', 'string','min:3' , 'max:50',new Name()],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique('teachers', 'email')->ignore($this->teacher->id)
            ],
            'rank' => ['required', 'string', 'max:50'],
            'institution' => ['required', 'string', 'max:255'],

        ];
    }
    
}
