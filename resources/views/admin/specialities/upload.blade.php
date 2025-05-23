
@extends('layouts.app')


@section('content')

    <x-form action="{{route('admin.emails-teacher.upload')}}"
 method="POST" :hasFiles="true" >
 <x-legend>Upload Teachers Emails</x-legend>
 <p class="p-2  text-center mt-2">Upload a CSV file for
    Emails .
     Expected columns: email</p>

        <div class="my-5">        
        <x-input-file   name="emails_file" label="Emails File"/>
        </div>
      



<x-button.submit />

</x-form>
 
@endsection