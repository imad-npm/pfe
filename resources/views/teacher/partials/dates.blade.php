
@php
    $startDate=\Carbon\Carbon::parse($proposalDate->start) ;
    $endDate=\Carbon\Carbon::parse($proposalDate->end)

@endphp

<div class=" rounded  shadow  p-4 mt-6 bg-white border-l-8 border-secondary-900 ">
<h2 class="text-2xl font-semibold mb-3 ">Important Dates</h2>
<div class="">
    <div>
    <span class="font-semibold text-lg me-2">Proposal start</span>
    {{$startDate}}
     @if ($startDate->lessThan(now()))
     <span class="mx-3 text-secondary">Started {{$startDate->diffForHumans(now())}}</span>
     @else 
     <span class="mx-3 text-secondary">Time Left {{$startDate->diffForHumans(now())}}</span>    
     @endif 
    
    </div>
    <div>
    <span class="font-semibold text-lg me-2">Proposal end</span>
    {{$endDate}}
    @if ($endDate->lessThan(now()))
    <span class="mx-3 text-danger">Ended {{$endDate->diffForHumans(now())}}</span>
    @else 
    <span class="mx-3 text-danger">Time Left {{$endDate->diffForHumans(now(),true)}}</span>    
    @endif 
</div>
</div>
</div>