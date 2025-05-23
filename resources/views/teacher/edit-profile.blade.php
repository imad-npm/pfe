@extends('layouts.app')

@section('content')


<x-form action="{{route('teacher.profile.update',[$teacher->id])}}" class="!mt-10 "  method="post"
     >

    @method('PUT')  

    <x-legend >
        Update Account Information

    </x-legend>
    <div class="my-3">
        <x-input-text required label="firstname" name="firstname" value="{{$teacher?->firstname ?? old('firstname')}}" />
</div> 

<div class="my-3">
    <x-input-text required label="lastname" name="lastname" value="{{$teacher?->lastname ??old('lastname')}}" />
</div> 
<div class="my-3">
    <x-input-text required label="rank" name="rank" value="{{ $teacher?->rank ?? old('rank')}}" />
</div>
    <div class="my-2 ">
        <x-input-password  label="password (Leave blank if not changing)" name="password" value="" />
    </div>
    <div class="my-2 ">
        <x-input-password label="confirm password" name="password_confirmation" value="" />
    </div>
       <x-button.submit text="Update" />

</x-form>
<div class="mx-auto m-10 border-danger border bg-white p-5 rounded-md  w-[90%] md:w-1/2  ">

    <h2 class="text-2xl font-semibold text-danger mb-3 ">Delete Account</h2>
<p class=" mb-3 ">
    Deleting your account is a permanent action and cannot be undone. All your data will be removed.

</p>
  
        <x-button.delete :route="route('teacher.profile.destroy')"
         class="bg-danger font-medium text-white rounded-md py-2 px-4 " text="Delete Account" /> 
  
    </div>
@endsection
