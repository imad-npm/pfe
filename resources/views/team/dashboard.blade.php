@extends('layouts.app')

@section('content')
<x-alert.success />

<div class="ps-5">
 <!--   <div class="p-3 text-3xl font-bold mb-5">
        Welcome, <span class="text-primary capitalize">
         {{$team->username}} </span> 
    </div> -->
<div class="px-6 mb-8 grid gap-9 md:gap-12 grid-cols-1 md:grid-cols-3 ">

<div class="  md:col-span-2  ">


 @include('team.partials.info-card',['team'=>$team])
</div>
<div class=" md:col-span-1">
 <div class="h-36">
    <x-dates.card :choiceDate="$choiceDate" /></div>
</div>
</div>
@endsection

