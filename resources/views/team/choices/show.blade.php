
@extends('layouts.app')

@section('content')
    

<div class="w-[90%] border shadow-lg 
 md:w-[70%] bg-white rounded-lg mx-auto rr my-10 p-6 md:p-7">
  
    @if (!isset($subjects))
        <h2 class="mt-5 mx-auto flex  items-center">No Choices to show .</h2>
    @else

<div class="mb-6">
<h3 class="text-center p-5 text-3xl mb-3 font-semibold
 rounded-md p-3 ">
   List of chosen subjects in order of preference
</h3>
</div>

<div >
    @for ($i = 1; $i <= 10; $i++)
        <div class="mb-2 border-b-2 flex gap-3 border-gray-200 pb-5 pt-2"> 
            <div class="h-10 me-3  w-10 bg-primary p-2 
            flex-shrink-0 font-bold text-white flex items-center
             justify-center rounded-full">
                {{$i}}
            </div>
           <div> <h3 class="font-semibold">Subject {{$i}} </h3>
           <span class="">  {{$subjects[$i-1] }}</span>
       </div>
     </div>
    @endfor
   </div>
        
    @endif
</div>
@endsection