@extends('layouts.guest')

@section('content')


<x-form action="{{route('admin.login')}}"  method="post" 
class="!w-[350px] md:!w-[35%]">

    <x-legend>Login</x-legend>
  
    <div class="my-3">
    <x-input-text required label="email" name="email" value="{{old('email')}}" />
</div>
    <div class="my-3 ">
        <x-input-password required label="password" name="password"
         value="{{old('password')}}" />
    </div>
    <div class="my-3">
    <input type="checkbox" name="remember"> Remember me
    </div>
    <x-button.submit class="w-full !rounded-md" text="Login" />

</x-form>


@endsection
