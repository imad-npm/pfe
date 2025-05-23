@extends('layouts.app')

@section('content')
<div class=" ps-6 mb-5 w-full ">
  <x-errors />
  <h3 class="text-4xl font-bold mb-5 ">Students</h3>


  <x-speciality.nav  :currentSpeciality="$speciality" :specialities="$specialities"
  :route="route('admin.students.index')"   />
  
  
<div class="flex justify-between mt-6 px-3  ">

<x-search-with-filters  :route="$speciality? route('admin.students.index',[$speciality]) :
 route('admin.students.index')" >
  <div class="">
    <span class="font-semibold">status</span>
    <x-select class="w-34" name="status" :options="[
      'with team'=>'with team','without team'=>'without team']"
    :selectedValue="request('status','')" />
</div>
</x-search-with-filters>
<a href="{{route('admin.students.index',    array_merge(request()->query(),['sort'=>1]))}}"
  class="border h-fit text-white bg-secondary font-medium  
  px-4 py-2 text-[0.93rem] rounded-md"> 
  <svg xmlns="http://www.w3.org/2000/svg" fill="none"
   viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
   class="size-6 inline">
    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
  </svg>
    Sort By Average
</a>
<x-button.upload  :route="route('admin.students.uploadForm')">
Upload Students
</x-button.upload>

</div>

@php
    $columns=['id','firstname','lastname','email','average','credit','decision',
"speciality"] ;

@endphp
<x-table :actions="false" :columns="$columns" >

    @foreach ($students as $student)
        <x-table.tr>
              
                <x-table.td>{{$student->id }}</x-table.td>
                <x-table.td>{{$student->firstname }}</x-table.td>
                <x-table.td>{{$student->lastname }}</x-table.td>
                <x-table.td>{{$student->email }}</x-table.td>
                <x-table.td>{{$student->average }}</x-table.td>
                <x-table.td>{{$student->credit }}</x-table.td>
                <x-table.td>{{$student->decision }}</x-table.td>
                <x-table.td>
                  @if ($student->speciality)
                     <x-speciality.badge>
                           {{$student->speciality?->abbreviation }}
   
                  </x-speciality.badge>   
                  @endif
                

                </x-table.td>

              
            <!--
            <x-table.td>
               <div class="flex gap-2  ">
                <x-table.edit-btn :route="route('admin.students.edit',[$student->id])" />
                <x-table.delete-btn :route="route('admin.students.destroy',$student->id)" />
                </div>
            </x-table.td>
        -->            
        </x-table.tr>

        @endforeach

</x-table>
  <div class="mt-3 w-1/2">
    {{ $students->links('vendor.pagination.tailwind') }}  </div>
@endsection

 </div>