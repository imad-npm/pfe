
@extends('layouts.guest')

@section('content')
<x-alert.success /> 
<x-errors />

<x-auth.email-notice :email1="$pendingTeam->student1_email ?? ''" 
    :email2="$pendingTeam->student2_email ?? ''" 
    :route="route('team.verification.resend',$pendingTeam->id)"/>

@endsection