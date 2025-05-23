@extends('layouts.guest')

@section('content')


<x-form action="{{route('teacher.register')}}"
  class=" !w-[350px] md:!w-[35%]"  method="post" 
>
<x-legend>Register</x-legend>

    <div class="my-3">
        <x-input-text required label="firstname" name="firstname" value="{{old('firstname')}}" />
</div> 

<div class="my-3">
    <x-input-text required label="lastname" name="lastname" value="{{old('lastname')}}" />
</div> 

<div class="my-3">
    <x-input-text required label="rank" name="rank" value="{{old('rank')}}" />
</div> 


    <div class="my-3">
        <x-input-text required label="email" name="email" value="{{old('email')}}" />
</div>

    <div class="my-3 ">
        <x-input-password required label="password" name="password" value="" />
    </div>
    <div class="my-3 ">
        <x-input-password required label="confirm password" name="password_confirmation" value="" />
    </div>
    <x-button.submit class="w-full !rounded-md" text="Register" />

    <div class="mt-4 ">Already have an account? 
        <a href="{{route('teacher.login')}}"
        class="text-primary">Login </a>
    </div>
</x-form>

@endsection
