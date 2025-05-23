@extends('layouts.guest')

@section('content')
<x-alert.success /> 
<x-errors />

<div class="p-6 w-[90%] mx-auto md:w-1/2 rounded-lg shadow-lg border mt-10">

<h2 class="font-semibold text-center text-2xl mb-5">
    Team Setup: One Step Left

</h2>
<p class="mb-3">
    Your email address is now confirmed. To complete your team setup,
     all members must validate their email addresses.
    </p>
     <p class="font-medium">
        Please ask your teammate to check their inbox and click the validation link.
     </p>
     <div class="mt-5">
     <a class="bg-primary text-white font-medium px-4 py-2 rounded-md" 
    href="{{route('team.verification.resend',$pendingTeam->id)}}">
    Resend Email to My Teammate
</a>
</div>
</div>
@endsection