@extends('layouts.app')



@section('content')


<x-form action="{{empty($team) ? route('admin.teams.store') :
 route('admin.teams.update',$team->id) }}"  method="post" 
 >
   
    @if(!empty($team))
    @method('PUT')  
    @endif

   <x-legend>{{!empty($team)? "Edit Team" : "Create a Team"}}</x-legend>
    <div class="my-3">
        <x-input-text required label="student1 email" name="student1_email"
        :value="old('student1_email',$team?->student1_email ?? '')" />

</div> 
    <div class="my-3">
        <x-input-text  label="student2 email" name="student2_email" 
        :value="old('student2_email',$team?->student2_email ?? '')" />

</div>
<div class="my-3">
<x-select label="speciality" id="speciality" class="block mt-1 w-full"
 name="speciality_id"
 :options="$specialities" :selectedValue="$team?->speciality_id?? '' "
  required  />

</div>
<div class="my-3">
    <x-input-text required label="username" name="username" 
    :value="old('username',$team?->username ?? '')" />
</div> 

    <div class="my-3 ">
        <x-input-password   
            :label="!isset($team) ? 'password' : 'password (Leave blank if not changing)'"
            :required="!isset($team)"
            name="password"  placeholder="password" />
    </div>
    <div class="my-3 ">
        <x-input-password
        :required="!isset($team)"

         label="confirm password" name="password_confirmation"  />
    </div>

  <x-button.submit  />
</x-form>

@endsection
