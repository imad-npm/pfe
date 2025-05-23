@extends('layouts.app')

@section('content')




<x-form action="{{route('team.profile.update')}}" 
class="!mt-10 !w-[90%] md:!w-1/2" method="post" >
 

    @method('PUT')  

    <legend class=" rounded  font-semibold
      text-2xl  p-3 text-center">
        Update Account Information

    </legend>




<div class="my-2">
    <x-input-text label="username" name="username" value="{{$team?->username ?? old('username')}}" />

</div> 

    <div class="my-2 ">
        <x-input-password placeholder="password" label="password (Leave blank if not changing)" name="password" value="" />
    </div>
    <div class="my-2 ">
        <x-input-password 
         label="confirm password" name="password_confirmation" value="" />
    </div>
       <x-button.submit text="Update" />
</x-form>
<div class="mx-auto m-10 border-danger rounded-lg border bg-white p-5  w-[90%] md:w-1/2  ">

    <h2 class="text-2xl font-semibold text-danger mb-3 ">Delete Account</h2>
<p class=" mb-3 ">
    Deleting your account is a permanent action and cannot be undone. All your data will be removed.

</p>
  
        <x-button.delete :route="route('team.profile.destroy')"
         class="bg-danger text-white font-medium rounded p-2 " 
         text="Delete Account" /> 
  
    </div>


    
@endsection
