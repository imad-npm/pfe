@extends('layouts.app')

@section('content')


  
<x-form action="{{ route('admin.specialities.store') }}" 
 method="post" >
  <x-legend>Create a Speciality</x-legend>
    <div class="m-2">
        <x-input-text required label="Abbreviation" name="abbreviation"
         :value="old('abbreviation')" />
</div> 



  <x-button.submit  />
</x-form>

@endsection
