@extends('layouts.guest')

@section('content')


<x-form action="{{route('teacher.login')}}"
   class="!w-[350px] md:!w-[35%]"  method="post" >

    <x-legend>Login</x-legend>

    <div class="my-3">
        <x-input-text required label="email" name="email" value="{{old('email')}}" />
    
    </div> 
    
        <div class="my-3 ">
            <x-input-password required label="password" name="password" value="" />
        </div>

      <div class="my-3 flex justify-between ">
            <div>
                <input type="checkbox" class="rounded me-1" name="remember" id=""> remember me
           </div>
            <a href="{{route('teacher.forgot-password')}}"
            class="text-primary">Forgot Password ?</a>
        </div>
        <x-button.submit class="w-full" text="Login" />

        <div class="mt-4 ">Don’t have an account yet? 
            <a href="{{route('teacher.register')}}"
            class="text-primary">Register</a>
        </div>
    </x-form>

@endsection
