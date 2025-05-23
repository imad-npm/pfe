@extends('layouts.app')

@section('content')


<x-subject.form :subject="$subject?? null" 
:action="empty($subject) ? route('admin.subjects.store') :
route('admin.subjects.update',$subject->id)" 
:options="$options"
:specialities="$specialities" 

/>

@endsection
