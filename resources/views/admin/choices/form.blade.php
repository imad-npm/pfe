@extends('layouts.app')

@section('content')

@php
    
@endphp

<x-form action="{{empty($choice) ? route('admin.choices.store') : 
route('admin.choices.update',$choice->id) }}"  method="post" 
>

   
    @if(!empty($choice))
    @method('PUT')  
    @endif

    <x-legend>
      {{!empty($choice) ? "Edit Choice" : "Create a Choice"}}
    </x-legend>
@if (auth("admin")->user())   

<input type="hidden" name="team_id" value="{{$teamId}}">

@endif
 
@for ($i = 1; $i <= 10; $i++)
    <div class="my-3">
    <x-datalist required label="{{'subject '. $i}}" 
     :selected_id="!empty($choice) ? data_get($choice,'subject'.$i.'_id')  : old('subject'.$i.'_id')"
        name="{{'subject'.$i.'_id'}}" :options="$options"  />
</div>
@endfor


  <x-button.submit  />
</x-form>

@endsection
