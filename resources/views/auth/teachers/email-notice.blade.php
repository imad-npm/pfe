@extends('layouts.guest')

@section('content')
<x-alert.success /> 
<x-errors />

<x-auth.email-notice :email1="$pendingTeacher->email ?? ''" 
    :route="route('teacher.verification.resend',$pendingTeacher->id)"/>

     

@endsection