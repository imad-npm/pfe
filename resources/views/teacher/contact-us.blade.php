@extends('layouts.app')



@section('content')

  
<x-contact.form  :route="route('teacher.contact.submit')"/>

@endsection