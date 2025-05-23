@extends('layouts.app')

@section('content')


  
<x-form action="{{ route('admin.emails-teacher.store') }}" 
 method="post" >

    <div class="m-2">
        <x-input-text required label="email" name="email"
         :value="old('email')" />
</div> 



  <x-button.submit  />
</x-form>

@endsection
