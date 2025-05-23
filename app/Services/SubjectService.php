<?php
namespace App\Services;

use App\Models\Speciality;


use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use ZipArchive;
use Barryvdh\DomPDF\Facade\Pdf;

class SubjectService
{


    public function getSubjects($search = null,$status=null,$speciality=null,
    $teacher=null,$paginated=true)
    {
        $subjects = Subject::with(["supervisor", "coSupervisor","team"]) ;

        if($teacher){
            $subjects=$subjects->where(function ($q) use ($teacher){
                $q->where("supervisor_id",$teacher->id)
            ->orWhere("co_supervisor_id",$teacher->id) ; }) ;

        }

        if($speciality){

        $speciality_id=Speciality::where("abbreviation",$speciality)->value("id") ;
   
        $subjects=$subjects->where(function ($q) use ($speciality_id) {
            $q->where("speciality1_id",$speciality_id)
        ->orWhere("speciality2_id",$speciality_id)
        ->orWhere("speciality3_id",$speciality_id) ;
        }) ;
    }
        if($status=="assigned"){
            $subjects = $subjects->where('is_assigned',true) ;
        
        }
         if($status=="not assigned"){
            $subjects = $subjects->where('is_assigned',null) ;

        }
        
        if (!empty($search))
       $subjects= $subjects->where(function ($q1) use ($search) {

                if(is_numeric($search)){
                $q1->
                where("id","$search")   ;
                } 
                $q1->orWhere("title", "like", "%$search%")
                ->orWhereHas("speciality1",function ($q) use ($search) {
                    $q->where("abbreviation", "like", "%$search%") 
                     ;
                })     
                ->orWhereHas("speciality2",function ($q) use ($search) {
                    $q->where("abbreviation", "like", "%$search%") 
                     ;
                })   
                ->orWhereHas("speciality3",function ($q) use ($search) {
                    $q->where("abbreviation", "like", "%$search%") 
                     ;
                })   
              //  ->orWhereRaw("match description against(? in boolean mode)",[$search]) 
              ->orWhere("description","like","%$search%")

              ->orWhere("tags","like","%$search%")
            
                ->orWhereHas("supervisor",function ($q) use ($search) {
                    $q->where("email", "like", "%$search%") 
                    ->orWhere("firstname","like","%$search%") 
                    ->orWhere("lastname","like","%$search%") 
                    ->orWhereRaw("concat(firstname,' ',lastname) like ?" ,["%$search%"])    ;
                    ;
                })
                ->orWhereHas("coSupervisor",function ($q) use ($search) {
                    $q->where("email", "like", "%$search%") 
                    ->orWhere("firstname","like","%$search%") 
                    ->orWhere("lastname","like","%$search%") 
                    ->orWhereRaw("concat(firstname,' ',lastname) like ?" ,["%$search%"])    ;
                    ;
                })  
                ;
            } ) ;

        return $paginated ? $subjects->paginate(10)->withQueryString() : $subjects->get() ;    
    }

   
    public function getTeacherOptions()
    {
        $teachers = Teacher::all();
        $options = $teachers->map(function ($teacher) {
            return [
                'id' => $teacher->id,
                "value" => "$teacher->firstname $teacher->lastname - $teacher->email"
            ];
        })->toArray();

        return $options;
    }

  

    public function createsubjectsZip($subjects)
    {
        $zip = new ZipArchive;
        $zipFileName = storage_path("app/public/subjects_exports.zip");

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
               
                $fileName = "subjects";

                $pdf = Pdf::loadView('admin.pdf.subjects', compact('subjects'));
                $zip->addFromString("$fileName.pdf", $pdf->output());

                $csvContent=$this->generateCsv($subjects) ;
                $zip->addFromString("$fileName.xlsx", $csvContent);

            
            $zip->close();
        }

        return $zipFileName ;
    }

    public function generateCsv($subjects)  {
        $file=fopen('php://temp','r+') ;
        $cols=['id','title','supervisor',
        'co_supervisor','speciality'] ;
        fputcsv($file,$cols) ;

        foreach ($subjects as $subject) {
            # code...
            fputcsv($file,[$subject->id,$subject->title,
            $subject->supervisor->firstname .' '.$subject->supervisor->lastname,
            $subject->coSupervisor?->firstname.' '.$subject->coSupervisor?->lastname ,
            ]) ;
        }
        rewind($file) ;
        return stream_get_contents($file) ;
        fclose($file) ;

    }

}
