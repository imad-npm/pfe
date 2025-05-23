@extends('layouts.app')

@section('content')


<div class="w-[90%]  my-5 px-6 py-10 md:w-[60%] mx-auto rounded-lg border shadow-lg">
  
    <h3 class="text-3xl font-semibold text-center mb-8">Edit Important Dates</h3>
    <x-errors />
    @session('success')
       <x-alert.success />
     
    @endsession
<form action="{{ route('admin.important-dates.update') }}" 
class="bg-slate-50 w-[90%] mx-auto rounded-lg p-6 shadow-lg rounded-xl border mb-8"
 method="post">
 @csrf
@method('Put')
<input type="hidden" name="type" value="proposal">

<x-legend >Proposal Period </x-legend>
    <div class=" mb-2">
    <div class="mb-2">
        <x-input-date label="proposal start" name="start"
        :value="old('proposal_start',$proposalDate?->start ?? '')" />
         
    </div>
         <x-input-date label="proposal end" name="end"
         :value="old('proposal_end',$proposalDate?->end ?? '')" />
        </div> 

        <x-button.submit  />
</form>
  
<form action="{{ route('admin.important-dates.update') }}" 
class="bg-slate-50 rounded-lg w-[90%] mx-auto p-6 shadow-lg rounded-xl border "
 method="post">
@csrf
@method('Put')

<x-legend >Choice Period</x-legend>
 <input type="hidden" name="type" value="choice">

<div class="mb-2">
    <x-input-date label="choice start" name="start"
    :value="old('choice_start',$choiceDate?->start ?? '')" />
</div>
    <x-input-date label="choice end" name="end"
    :value="old('choice_end',$choiceDate?->end ?? '')" />


  <x-button.submit  />
</form>

</div>
@endsection
