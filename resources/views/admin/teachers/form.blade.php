@extends('layouts.app')

@section('content')

@php
    use App\Constants\TeacherType ;
    $action = isset($teacher) ? route("admin.teachers.update",[$teacherType,$teacher->id]) : 
                route("admin.teachers.store",$teacherType)
@endphp


<x-teacher.form
:action="$action"
:teacher="$teacher ?? null"
:teacherType="$teacherType"
/>

@endsection
