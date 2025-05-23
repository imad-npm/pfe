@php
    use App\Models\Speciality;
@endphp

@props(['route'=>"","currentSpeciality"=>null,"specialities"=>null])

@php    
$default=" rounded bg-slate-200 text-gray-600 font-medium py-1 px-3";
$active= "rounded  font-medium py-1 px-3 bg-primary text-white" ;


function setSpeciality($speciality)  {
    $params=request()->query() ;
unset($params["page"]) ;
$params['speciality']=$speciality ;
$paramsString=count($params)==0 ? "" : '?'.http_build_query($params) ;

    return $paramsString ;
}
@endphp
<nav class="m-3">
    <ul class="flex gap-3 justify-center">

        <li class="  {{$currentSpeciality == null ? $active : $default}}">
            <a href="{{$route}}{{setSpeciality('')}}">All</a>
            </li>
        @foreach ($specialities as $speciality)
        <li class=" {{$currentSpeciality == $speciality->abbreviation ? $active : $default}}">
            <a href="{{$route}}{{setSpeciality($speciality->abbreviation)}}">
                {{ $speciality->abbreviation }} 
               </a>
            </li>
        @endforeach
        

    
    </ul>
    </nav>