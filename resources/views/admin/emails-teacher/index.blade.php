@extends('layouts.app')

@section('content')

@php

$columns=['id','email'] ;

@endphp

<div class=" ps-6 mb-5 w-full">
  <x-errors />
  <h3 class="text-4xl font-bold mb-8 ">Teachers Emails </h3>

  <div class="flex justify-between mt-6 px-3 h-10">

<x-search :route=" route('admin.emails-teacher.index')" />
<x-button.upload :route="route('admin.emails-teacher.upload-form')">
    Upload  Emails
    </x-button.upload>

<x-button.create text="add email" :route="route('admin.emails-teacher.create')" />

  </div>




<x-table :columns="$columns" >

    @foreach ($emails as $email)
        <x-table.tr>
            @foreach ($columns as $col)
                <x-table.td>{{$email->$col}}</x-table.td>
            @endforeach
            <x-table.td>
                <div class="flex gap-2  ">
                <x-table.delete-btn :route="route('admin.emails-teacher.destroy',$email->id)"  />
                </div>
            </x-table.td>
        </x-table.tr>
    @endforeach

</x-table>

  <div class="mt-3 w-1/2">
    {{ $emails->links('vendor.pagination.tailwind') }}  </div>


 </div>
 @endsection