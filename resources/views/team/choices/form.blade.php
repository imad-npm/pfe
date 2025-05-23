@extends('layouts.app')

@section('content')

@php
    
@endphp


<x-alert.info>
   You can only submit your choices once. Please double-check everything before submitting.

</x-alert.info> 

<x-form action="{{route('team.choices.store') }}" class="!mt-5"  method="post"
x-data="{
open:false,
subjects:[]
}"
 @submit.prevent="open=true" >

    @if(!empty($choice))
    @method('PUT')  
    @endif
    
    @csrf

    <x-legend >Submit a Choice</x-legend>
 
@for ($i = 1; $i <= 10; $i++)


    <div class="my-3">
    <x-datalist required :label="'subject '. $i"  :selected_id="!empty($choice) ? 
    data_get($choice,'subject'.$i.'_id')  : old('subject'.$i.'_id')"
        :name="'subject'.$i.'_id'" :options="$options" 
        x-model="subjects[{{$i}}]" />
</div>
@endfor

<div x-show='open' x-cloak id="modal" class="fixed top-0 left-0 
bg-black bg-opacity-50  w-full flex justify-center
z-50 ">  
<div class=" w-1/2 mt-10 bg-white overflow-y-auto h-[90vh]                                     
           mx-auto shadow-md p-6 rounded-md ">

  <p class="mb-6 font-semibold text-xl">Selected Subjects</p>
  @for ($i = 1; $i <= 10; $i++)
  <div class="mb-3 border-b-2 pb-2">
    <span class="font-semibold ">{{$i}}</span> 
    <span class="subject-preview  mx-3  "
    x-text="subjects[{{$i}}]"></span>
</div>
@endfor
<div class="flex gap-3">
  <button id="confirm" type="button"
   @click="$el.closest('form').submit()"
     class=" rounded px-3 py-1 bg-primary text-white font-medium">Submit</button>
  <button id="cancel" type="button" @click="open=false" class=" rounded px-3 py-1
   bg-danger text-white font-semibold">Cancel</button>
</div>

</div>


</div>
  <x-button.submit  />
</x-form>



@endsection
