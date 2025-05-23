

@extends('layouts.app')


@section('content')

@if ($specialities->isEmpty())
 <x-alert.info>
    You need to add specialities
 </x-alert.info>
        

    @else
        



    <x-form action="{{route('admin.students.upload')}}"
 method="POST" :hasFiles="true" >
 <x-legend>Upload Students</x-legend>
 <p class="p-2  text-center mt-2">Upload a CSV file for  students.
     Expected columns: N°,N° d'inscription,Nom,Prénom,MG,Crédit aquis,Décision
    </p>
    
<div class="flex flex-col gap-3">
     @foreach ($specialities as $speciality)
        <div>        
        <x-input-file  name="{{$speciality->abbreviation}}" label="{{$speciality->abbreviation}}"/>
        </div>
        @endforeach
</div>


<x-button.submit />

</x-form>

     @endif
@endsection