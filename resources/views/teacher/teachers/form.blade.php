@extends('layouts.app')

@section('content')

@php
    use App\Constants\TeacherType ;
    $action = isset($teacher) ? route("teacher.teachers.update",[$teacher->id]) : 
                route("teacher.teachers.store")
@endphp


<x-teacher.form
:action="$action"
:teacher="$teacher ?? null"
:teacherType="TeacherType::EXTERNAL"
/>

@endsection