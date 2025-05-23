@extends('layouts.app')



@section('content')

 <!---
<div class="ps-5">
    <div class="p-3 text-3xl font-bold mb-5">
        Welcome, <span class="text-primary capitalize">
         {{$teacher->fullName}} </span> 
   
        </div> -->
<x-errors :errors="$errors" />
    <div class="mb-6 ps-4 grid grid-cols-3 gap-3 ">
        
    <div class="p-6  bg-white border rounded-lg shadow-md col-span-2  ">

        <h4 class="mb-3  text-3xl font-bold     pb-3    border-b-2">Subjects
            Overview
        </h4> 
         <div class=" p-3 mb-2  ">
            <p class=" font-semibold">Total Subjects</p>
            <span class="font-semibold text-3xl text-primary">{{$subjects['total']}} </span>
         </div>

        <div class="flex justify-around p-3">
        @foreach ($specialities as $speciality)
           <div class="rounded p-3  bg-slate-50  text-center shadow w-1/6  
          border">
            <p class="font-semibold text-xl  rounded-md">
                {{$subjects[$speciality->abbreviation]}} </p>
             <p class=""> {{ $speciality->abbreviation }} </p>
         </div>
         
        @endforeach
       
         <div class="rounded p-3  shadow w-1/6  text-center
           bg-slate-50 border rounded-md">
            <p class="font-semibold text-xl text-success">{{$subjects['assigned']}} </p>
             <p class=""> Assigned </p>
         </div>
         <div class="rounded p-3 w-1/6   text-center shadow
           bg-slate-50 border rounded-md">
            <p class="font-semibold text-xl text-danger">{{$subjects['notAssigned']}} </p>
             <p class=" leading-tight "> Not Assigned </p>
         </div>
        
     </div>
     
     </div>
  <div class="col-span-1 b">
<x-dates.card :proposalDate="$proposalDate" />
</div>   
</div>

</div>

@endsection