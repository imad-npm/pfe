@extends('layouts.guest')


@section('content')


<x-form action="{{route('team.register')}}"  class="
!w-[350px] md:!w-[35%]"  method="post" >

    <x-legend>Register</x-legend>
    
    <div class="my-3">
        <x-input-text required label="student1 email" name="student1_email" value="{{old('student1_email')}}" />

</div> 
    <div class="my-3">
        <x-input-text  label="student2 email" name="student2_email" value="{{old('student2_email')}}" />

</div>
<div class="my-3">
<x-select  id="speciality"
 label='speciality' class="block mt-1 w-full" name="speciality_id"
  :options="$specialities" 
 required autofocus autocomplete="username" />

</div>
<div class="my-3">
    <x-input-text required label="username" name="username" value="{{old('username')}}" />

</div> 

    <div class="my-3 ">
        <x-input-password required  label="password" name="password" value="" />
    </div>
    <div class="my-3 ">
        <x-input-password required label="confirm password" name="password_confirmation" value="" />
    </div>
    
       <x-button.submit class="w-full !rounded-md" text="Register" />

       <div class="mt-4 ">Already have an account? 
        <a href="{{route('team.login')}}"
        class="text-primary">Login </a>
    </div>

    </x-form>

@endsection
