<?php

namespace App\Http\Requests\Admin\ImportantDate;

use Illuminate\Foundation\Http\FormRequest;

class ImportantDateRequest extends FormRequest
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
             "type"=>["required","string"],
            "start"=>["required","date"],
            "end"=>["required","date","after:start"],
           

        ];
    }
}
