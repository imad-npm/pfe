@extends('layouts.app')

@section('content')

@php

$columns=['id','abbreviation'] ;

@endphp

<div class=" ps-6 w-full">
  <x-errors />
  <h3 class="text-4xl font-bold mb-8 ">Specialities</h3>

  <div class="flex justify-between mt-6 px-3 h-10">

<x-search :route=" route('admin.specialities.index')" />


<x-button.create text="Add speciality" :route="route('admin.specialities.create')" />

  </div>




<x-table :columns="$columns" >

    @foreach ($specialities as $speciality)
        <x-table.tr>
            @foreach ($columns as $col)
                <x-table.td>{{$speciality->$col}}</x-table.td>
            @endforeach
            <x-table.td>
                <div class="flex gap-2  ">
                <x-table.delete-btn 
                confirm='Deleting this speciality will also remove all teams and subjects linked to it.'
                :route="route('admin.specialities.destroy',$speciality->id)"
                  />
                </div>
            </x-table.td>
        </x-table.tr>
    @endforeach

</x-table>

  <div class="mt-3 w-1/2">
    {{ $specialities->links('vendor.pagination.tailwind') }}  </div>


 </div>
 @endsection