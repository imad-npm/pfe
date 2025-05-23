<?php

if(!function_exists('validateColumns')){

    function validateColumns($path,$requiredColumns){
        
        $file=fopen($path,"r") ;
        $headers=fgetcsv($file) ;
      
    fclose($file) ;

        return empty(array_diff($requiredColumns,$headers)) ;
        
    }

    function containsRows($path){
        
        $file=fopen($path,"r") ;
        $headers=fgetcsv($file) ;
        $row=fgetcsv($file) ;

      
    fclose($file) ;
     
        return $row[0] ? true : false ;
        
    }
}