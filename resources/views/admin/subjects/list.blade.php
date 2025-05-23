@extends('layouts.app')

@section('content')
 
<x-search :route="isset($speciality )
 ? route('teacher.subjects.index',[$speciality])
   : route('teacher.subjects.index')"
   />
   <x-speciality.nav :route="route('teacher.subjects.index')" :speciality="$speciality"  />

@foreach ($subjects as $subject)
    <x-subject.item :subject="$subject" />
@endforeach

@endsection