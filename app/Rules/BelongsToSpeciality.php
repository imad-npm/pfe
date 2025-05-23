<?php
namespace App\Rules;

use App\Models\Student;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class BelongsToSpeciality implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    private $speciality ;

    public function __construct($speciality) {
        $this->speciality = $speciality;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $email=$value ;     
      //  $id=intval(strstr( $email,"@",true ) ) ;
//        $student=DB::table("students_$this->speciality")->find($id) ;
        $student=Student::with("email")->where("speciality_id",$this->speciality )
        ->whereHas('email',function ($q) use($email) {
            $q->where("email",$email ) ;
        })
        ->first() ;
        
if(is_null($student)){
            $fail('This student does not belong to the selected speciality.');
        }
    }
}
