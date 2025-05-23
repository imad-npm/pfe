@extends('layouts.app')

@section('content')


<x-subject.form :subject="$subject ?? null" 
:action="empty($subject) ? route('teacher.subjects.store') :
route('teacher.subjects.update',$subject->id)" 
:options="$options"
:specialities="$specialities" 

/>
@endsection
