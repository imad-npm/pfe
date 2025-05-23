<?php

namespace App\Http\Requests\Admin\Student;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
            'IAA' => 'nullable|file|csv',
            'SID' => 'nullable|file|csv' ,
            'RSID' => 'nullable|file|csv',

        ];
    }
    public function messages()
    {
        return [
            "IAA.file"=>'The IAA file must be a valid file.' ,
            "IAA.csv"=>'The IAA file must be a CSV file.' ,
            "SID.file"=>'The SID file must be a valid file.' ,
            "SID.csv"=>'The SID file must be a CSV file.' ,
            "RSID.file"=>'The RSID file must be a valid file.' ,
            "RSID.csv"=>'The RSID file must be a CSV file.' ,
        
            ] ;
    }
}
