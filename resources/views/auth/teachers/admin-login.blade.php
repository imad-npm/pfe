@extends('layouts.app')

@section('content')

<div class="form-container mx-auto mt-48  w-[300px]">
@if (session("error"))
<p class="text-danger">{{ session("error") }}</p>
@endif
<form action="{{route("admin.login")}}"  method="post" class=" bg-slate-100 p-4">
    <legend>Admin</legend>
    @csrf
    <div class="my-3">
    <x-input-text required name="email" value="{{old('email')}}" />
</div>
    <div class="my-3 ">
        <x-input-password required name="password" value="{{old('password')}}" />
    </div>
       <button type="submit" class="bg-primary p-2">Login</button>
</form>
</div>
@endsection
