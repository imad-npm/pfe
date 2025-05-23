<?php

namespace App\Http\Requests\Admin\Choice;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChoiceRequest extends FormRequest
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
       $rules=[] ;
       
        $rules["team_id"]=["required",Rule::exists('teams','id')] ;
        for ($i=1;  $i <= 10;  $i++)  { 
            # code...
            $rules["subject$i"."_id"]=["required",Rule::exists('subjects','id')] ;
        }
        return $rules ;
           
            //
            //"subject_id"=>["required",Rule::exists('subjects','id'),'different']
    
   // dd(request()->all()) ;
    /*return [
        "subjects"=>['required',"array","size:10"] ,
        "subjects.*"=>[Rule::exists('subjects','id')]
    ]    ;*/
    }

    public function messages()
    {
        $messages=[
            "team_id.required"=>"The team is required." ,
            "team_id.exists"=>"The team does not exist."
        ] ;

        for ($i=1;  $i <= 10;  $i++)  { 
        $messages["subject{$i}_id.required"]="Subject $i is required." ;
        $messages["subject{$i}_id.exists"]="Subject $i must be a valid subject." ;

        }
        return $messages ;
    }
    
}
    

