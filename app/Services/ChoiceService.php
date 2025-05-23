<?php

namespace App\Services;

use App\Models\Subject;
use App\Models\Team;

 class ChoiceService{

    

    public function getSubjectOptions($teamId) {
    
        $team=Team::find($teamId) ;

        $subjects=Subject::where(function ($q) use ($team) {
            $q->where("speciality1_id",$team->speciality_id)
        ->orWhere("speciality2_id",$team->speciality_id)
        ->orWhere("speciality3_id",$team->speciality_id) ;
        }) 
        ->get(['id',"title"]) ; 

        $options= $subjects->map(function ($subject) {
            return ['id'=>$subject->id ,
            "value"=>"$subject->title"] ;
       })->toArray() ;
        return $options ;
}

public function getSubjectIds($choice)  {
    
    $subjectIds=collect(range(1,10))->map(function ($elm) use ($choice)  {
        return $choice->{"subject$elm"."_id"} ;
    })->toArray() ;

    return $subjectIds;
}

public function getSubjects($choice){
    $subjectIds = collect(range(1, 10))->map(function ($elm) use ($choice) {
        return $choice->{"subject$elm" . "_id"};
    })->toArray();

    $subjects = Subject::whereIn('id', $subjectIds)
        ->orderByRaw("field (id," . implode(',', $subjectIds) . " )")
        ->pluck('title'); ;
    return $subjects ;
}


 }