
@extends('layouts.app')

@section('content')
    
<div class="container  mx-auto">

<div class="mt-10 mb-3 flex justify-end gap-3 ">

<a href="{{route('admin.choices.edit',$choice->id)}}"
class="rounded-md px-4 py-2 bg-secondary text-secondary-600 border-secondary-600 border "
>Edit</a>
<x-button.delete :route="route('admin.choices.destroy',$choice->id)" 
  class="rounded-md px-4 py-2 bg-red-50 text-danger border-red-400 border "   />



</div>

<div class=" border shadow-lg 
 bg-white rounded-lg mx-auto  mb-10  p-6 md:p-7">
  
    @if (!isset($subjects))
        <h2 class="mt-5 mx-auto flex  items-center">No Choices to show .</h2>
    @else

<div class="">
<h3 class="text-center p-5 text-3xl mb-3 font-semibold
 rounded-md p-3 mb-6 ">
  Team <span>#{{$choice->team->id}}</span> Choice
</h3>


<div >
    @for ($i = 1; $i <= 10; $i++)
        <div class="mb-2 border-b-2 flex gap-3 border-gray-200 pb-5 pt-2"> 
            <div class="h-10 me-3  w-10 bg-primary p-2 
            flex-shrink-0 font-bold text-white flex items-center
             justify-center rounded-full">
                {{$i}}
            </div>
           <div>
            @if (isset($subjects[$i-1] ))
                <h3 class="font-semibold">Subject {{$i}} </h3>
           <span class="">  {{$subjects[$i-1] ?? '' }}</span>
           <span><a class="text-primary underline" 
            href="{{route('admin.subjects.index',
            ['search'=>$subjects[$i-1]])}}">
               Details
            </a> 
        </span> 
            @endif
            
       </div>
     </div>
    @endfor
   </div>
        
    @endif
</div>

@endsection