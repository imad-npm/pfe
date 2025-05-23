<?php

namespace App\Http\Requests\Admin\Subject;

use App\Rules\Tags;
use App\Rules\TeacherExists;
use Illuminate\Foundation\Http\FormRequest;

class CreateSubjectRequest extends FormRequest
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
            "title"=> "required|string|min:10|max:250|unique:subjects,title"  ,
            "description"=> "required|string|min:10|max:3000", 
            'tags' => ['nullable', 'string', new Tags,
             'min:2', 'max:30'],

            "supervisor_id"=>'required|string|exists:teachers,id'  , 
            "co_supervisor_id"=>'nullable|string|exists:teachers,id|different:supervisor_id' ,
            "speciality1_id"=>'required|exists:specialities,id' ,
            "speciality2_id"=>'nullable|exists:specialities,id|different:speciality1_id' ,
            "speciality3_id"=>'nullable|exists:specialities,id|different:speciality1_id,speciality2_id' 
       ];
    }
    public function messages()
    {
        return [
            "supervisor_id.required"=>"A supervisor is required." ,
            "supervisor_id.exists"=>"The selected supervisor does not exist." ,
            "co_supervisor_id.exists"=>'The selected co-supervisor does not exist.' ,
            "co_supervisor_id.different"=>'The co-supervisor must be different from the supervisor.' ,
            "speciality2_id.different"=>'The speciality 2 must be different from speciality 1.' ,
            "speciality3_id.different"=>'The speciality 3 must be different from speciality 2 and speciality 1.' ,

        ] ;
    }
}
