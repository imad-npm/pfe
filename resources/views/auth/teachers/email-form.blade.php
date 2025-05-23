
@extends('layouts.guest')

@section('content')
 

        
<x-form action="{{route('teacher.forgot-password.email')}}" 
 method="POST">
    <x-legend>Forgot Password</x-legend>
    <p class=" m-4">  We will send you an email with a link to reset your password. Please check your inbox, including your spam folder, for this email.
    </p>
    <div class="mb-4">
    <x-input-text name="email" label="email" />
</div>
    <x-button.submit />
</x-form>

@endsection