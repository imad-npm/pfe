 
@props(['proposalDate'=>null , "choiceDate"=>null])

@php
if(isset($proposalDate)){
    $proposalDate->start=\Carbon\Carbon::parse($proposalDate->start) ;
    $proposalDate->end=\Carbon\Carbon::parse($proposalDate->end) ;
}
if(isset($choiceDate)){  
    $choiceDate->start=\Carbon\Carbon::parse($choiceDate->start) ;
    $choiceDate->end=\Carbon\Carbon::parse($choiceDate->end) ;
}
@endphp

<div class=" rounded-xl mx-5  shadow  p-5  bg-white min-h-32 ">
<h2 class="text-2xl font-semibold mb-3 border-b-2 pb-3 border-gray-300">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
             stroke-width="1.5" stroke="currentColor" class="size-8 inline 
             text-primary">
                <path stroke-linecap="round" stroke-linejoin="round"
                 d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 
                 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 
                 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25
                  2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
              </svg>    Important Dates
</h2>
<div class=" =">

<div class="mb-5">
    @if (isset($proposalDate))
    <div class=" mb-5">
        <div class="mb-2">

        <p class="font-semibold text-lg me-2">
                     Proposal Period start
        </p>
      <p class="text-primary">  {{$proposalDate->start}}</p>
         @if ($proposalDate->start->lessThan(now()))
         <p class=" text-success">Started {{$proposalDate->start->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>
         @else 
         <p class=" text-success">Time Left {{$proposalDate->start->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>    
         @endif 
        </div>
    
       
         <div>
        <p class="font-semibold text-lg me-2">Proposal Period end</p>
        <p class="text-primary">{{$proposalDate->end}}</p>
        @if ($proposalDate->end->lessThan(now()))
        <p class=" text-danger">Ended {{$proposalDate->end->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>
        @else 
        <p class=" text-danger">Time Left {{$proposalDate->end->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>    
        @endif 
    </div>
    
    </div>
    

@endif

@if(isset($choiceDate))
<div class=" ">
    <div class="mb-2">
    <p class="font-semibold text-lg me-2">Choice Period start</p>
  <p class="text-primary">  {{$choiceDate->start}}</p>
     @if ($choiceDate->start->lessThan(now()))
     <p class=" text-success">Started {{$choiceDate->start->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>
     @else 
     <p class=" text-success">Time Left {{$choiceDate->start->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>    
     @endif 
    </div>

   
     <div>
    <p class="font-semibold text-lg me-2">Choice Period end</p>
    <p class="text-primary">{{$choiceDate->end}}</p>
    @if ($choiceDate->end->lessThan(now()))
    <p class=" text-danger">Ended {{$choiceDate->end->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>
    @else 
    <p class=" text-danger">Time Left {{$choiceDate->end->diffForHumans(["parts"=>2,"join"=>" and "])}}</p>    
    @endif 
</div>

</div>

    @endif

 </div> 
 @if (auth('admin')->check())
   <a class="rounded-md py-2 px-5 inline-block 
    bg-primary text-white border  " href="{{route('admin.important-dates.edit')}}">
    Edit
 </a>   
 @endif

</div>
