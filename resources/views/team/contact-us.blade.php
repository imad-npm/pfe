@extends('layouts.app')



@section('content')

<x-contact.form  :route="route('team.contact.submit')"/>

@endsection