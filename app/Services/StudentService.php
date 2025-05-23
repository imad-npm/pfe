<?php

namespace App\Services;

use App\Models\Speciality;

use App\Models\Student;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class StudentService
{

 

    public function getStudents($search = null, $speciality = null, $status = null,$sort=null)
    {

        $query = Student::with(["email","speciality"]);

        if ($speciality)
            $query->whereHas("speciality",function ($q) use($speciality){
                $q->where("abbreviation",$speciality) ;
            });
        
        if ($status == "with team")
        $query->where(function ($q) use ($search) {
            $q->whereHas("teamAsFirst")
                ->orWhereHas('teamAsSecond');
        }) ;

        if ($status == "without team")
        $query->where(function ($q) use ($search) {
            $q->whereDoesntHave("teamAsFirst")
                ->WhereDoesntHave('teamAsSecond');
            } ) ;

        if ($search) {
             $query->where(function ($q) use ($search) {
            $q->where("firstname", "like", "%$search%")
                ->orWhere("lastname", "like", "%$search%")
                ->orWhere("id","$search")    
                ->orWhere("credit", "like", "%$search%")

                ->orWhere("decision", "like", "%$search%")

                ->orWhereRaw("concat(firstname,' ',lastname) like ?", ["%$search%"])
                ->orWhereHas(
                    "email",
                    function ($q) use ($search) {
                        $q->where("email", "like", "%$search%");
                    }
                );
                 }) ;
                

        } 
      
                 if($sort){
                    $query->orderByDesc("average") ;
                }
        return  $query->paginate(10)->withQueryString();
    }
    

    public function storeUploadedStudents($speciality)
    {
        // N°,N° d'inscription,Nom,Prénom,MG,Crédit aquis,Décision
        /*class Etudiant {
    - int matricule
    - String nom
    - String prenom
    - String email
    - float moyenne
}*/
        $path = storage_path("app/private/uploads/students_$speciality.csv");

        if (!file_exists($path))
            return;

        $handle = fopen($path, "r");
        $header = fgetcsv($handle);
        // $emailId=1 ;
        $speciality_id =Speciality::where('abbreviation',$speciality)->first()->id ;
        Student::where("speciality_id",$speciality_id)->delete();
        // DB::table("emails_students")->delete() ;

        $students = [];
        $emails = [];
        while ($row = fgetcsv($handle)) {
            $row = array_combine($header, $row);
            $student_number = substr(trim($row["N° d'inscription"]), 10);
            $email = "$student_number@etu.univ-usto.dz";
            //  $emailId++ ;
            $emails[] = [
                "student_id" => $student_number,
                "email" => $email,
                "created_at" => now(),
                "updated_at" => now()
            ];
            $students[] =    [
                "id" => $student_number,
                "lastname" => trim($row["Nom"]),
                "firstname" => trim($row["Prénom"]),
                "average" => floatval(trim(str_replace(",", ".", $row["MG"]))),
                "credit" => intval(trim($row["Crédit aquis"])),
                "decision" => trim($row["Décision"]),
                "speciality_id"=>$speciality_id ,
                "created_at" => now(),
                "updated_at" => now()
            ];
        }

        DB::table("emails_students")->insertOrIgnore($emails);

        Student::insertOrIgnore($students);
    }
}
