<?php
namespace App\Http\Requests\Admin\Team;


use Illuminate\Foundation\Http\FormRequest;
use App\Models\Team;
use App\Rules\BelongsToSpeciality;
use App\Rules\UsernameRule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Allow the request
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['required', 'string', 'max:255','min:3' ,  new UsernameRule,
             Rule::unique('teams', 'username')],
            'student1_email' => ['required', 'string', 'lowercase', 'email', 'max:255',
             Rule::unique('teams', 'student1_email'),
             Rule::unique('teams', 'student2_email'),
                                Rule::exists("emails_students","email")
                                ,new BelongsToSpeciality($this->input('speciality_id'))],

            'student2_email' => ['nullable', 'string', 'lowercase', 'email', 'max:255', 
            Rule::unique('teams', 'student2_email'),
            Rule::unique('teams', 'student1_email'),

                Rule::exists("emails_students","email"),
                'different:student1_email',
                new BelongsToSpeciality($this->input('speciality_id'))],
                
            'speciality_id' => ['required', 'exists:specialities,id', 'max:255'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }
}
