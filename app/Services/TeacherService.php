<?php

namespace App\Services;

use App\Constants\TeacherType;
use App\Models\Teacher;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage ;
use Illuminate\Support\Facades\DB ;
use ZipArchive;

 class TeacherService{


    public function getTeachers($search=null,$addedBy=null,$type=null,$paginated=true){

       $query=Teacher::with('addedBy') ;
        
        if($type==TeacherType::EXTERNAL || $type==TeacherType::INTERNAL)
        {
           $query->where('type',$type) ;
        }
        if($search){
          $query->where(function ($q) use ($search) {
            $q->where("id","$search")
            ->orWhere("firstname","like","%$search%")
            ->orWhere("lastname","like","%$search%")
            ->orWhereRaw("concat(firstname,' ',lastname) like ?", ["%$search%"])
            ->orWhere("email","like","%$search%")
            ->orWhere("rank","like","%$search%")
            ->orWhere("type","like","%$search%")
            ->orWhere("institution","like","%$search%") 
            ->orWhereHas('addedBy',function ($q) use ($search) {
                $q->where('firstname',"like","%$search%")
                ->orwhere('lastname','like',"%$search") ;
            }) ;
            }) ;
     
        } 

        if($addedBy)
            $query->where("added_by_id","$addedBy") ;

      
        
      return  $paginated ? $query->paginate(10)->withQueryString() : $query->get() ;
        
    }


    public function createTeachersZip()
    {
        $zip = new ZipArchive;
        $zipFileName = storage_path("app/public/teachers_exports.zip");

        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
           
                # code
                $teachers = $this->getTeachers(type:TeacherType::EXTERNAL);

                $pdf = Pdf::loadView('admin.pdf.external-teachers', compact('teachers'));

                $zip->addFromString("external_teachers_external.pdf", $pdf->output());
                
                $csvContent=$this->generateCsv($teachers) ;
                $zip->addFromString("external_teachers_external.xlsx", $csvContent);

            
            $zip->close();
        }

        return $zipFileName ;
    }

    public function generateCsv($teachers)  {
        $file=fopen('php://temp','r+') ;
        $cols=['id','firstname','lastname','email','rank','type','added by',
        'institution'];
        fputcsv($file,$cols) ;

        foreach ($teachers as $teacher) {
            # code...
            fputcsv($file,[$teacher->id,
            $teacher->firstname,
            $teacher->lastname,
            $teacher->email,
            $teacher->rank,
            $teacher->type,
            $teacher->addedBy?->firstname .' '.$teacher->addedBy?->lastname,
            $teacher->institution
            ]) ;
        }
        rewind($file) ;
        return stream_get_contents($file) ;
        fclose($file) ;

    }

    
        
}