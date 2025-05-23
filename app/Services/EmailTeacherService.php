<?php

namespace App\Services;

use App\Models\Teacher;
use Illuminate\Support\Facades\Storage ;
use Illuminate\Support\Facades\DB ;

 class EmailTeacherService{

    public function storeUploadedEmails() {
        
        $path=storage_path("app/private/uploads/emails_teachers.csv") ;
        
        if(!file_exists($path))
        return ;

        $handle=fopen($path,"r");
        $header=fgetcsv($handle) ;

        $emails=[] ;
        DB::table("emails_teachers")->delete() ;
/*
        while ($row=fgetcsv($handle)) {
            $row=array_combine($header,$row) ;
            DB::table("emails_teachers")->updateOrInsert([
                "email"=>$row["email"]
            ],[
                "created_at"=>now() ,
                "updated_at"=>now()
            ]) ;
        }
   */
  while ($row=fgetcsv($handle)) {
    $row=array_combine($header,$row) ;
    $emails[]=[
        "email"=>$row["email"] ,
        "created_at"=>now() ,
        "updated_at"=>now()
    ] ;
}
DB::table("emails_teachers")->insert($emails) ;



}
}


