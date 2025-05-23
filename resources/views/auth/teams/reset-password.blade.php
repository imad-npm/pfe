@extends('layouts.guest')

@section('content')


<x-form action="{{route('team.reset-password')}}" 
 method="POST">
 
 <x-legend>Reset Password</x-legend>
   <div class="mb-3"> <x-input-text label="email" name="email" placeholder="type your email" />
</div>
   
   
    <input  value="{{$token}}" name="token" hidden />
    <div class="mb-3">    <x-input-password label="New Password"
          name="password" placeholder="type your password" />
</div>

    <div class="mb-3">  
          <x-input-password label="Confirm password" 
           name="password_confirmation" placeholder="retype your password" />
</div>

    <x-button.submit />
</x-form>

@endsection