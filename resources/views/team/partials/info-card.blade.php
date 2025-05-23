

<div class="   mx-auto p-4 shadow-lg border rounded-md bg-white ">

<h3 class="text-3xl mb-3 font-bold   p-3">
    Team Info</h3>
    <div class="p-2">
<div class="group mb-3 border-b-2 pb-5">
 <h3 class="text-xl mb-1  font-semibold "> Student 1 : </h3>

    <div> <span class=" font-semibold me-2"> Full Name </span>
        {{$team->student1?->fullName}} </div>
        <div> <span class=" font-semibold me-2 "> Email </span>
             {{$team->student1_email}}  </div>
  </div>
    @if ($team->student2)
  <div class="group mb-3 border-b-2 pb-5">
    <h3 class="text-xl font-semibold mb-1 "> Student 2 : </h3>
    <div> <span class=" font-semibold me-2 "> Full Name </span>
        {{$team->student2->fullName }} 
    </div>
    <div> <span class=" font-semibold me-2 "> Email </span>
        <span class=""> 
               {{$team->student2_email}} 
            </span>
    
     </div>
</div>
 @endif

<div class="group flex items-baseline mb-3  ">

    <span class="text-xl font-semibold me-2 "> Speciality :</span>  
     <x-speciality.badge> {{$team->speciality->abbreviation}}

     </x-speciality.badge>
    

</div>

<div class="group flex items-baseline mb-3  ">

    <span class="text-xl font-semibold me-2  ">  Average :</span>  
     <span class="uppercase ">{{$team->max_average}}</span>

</div>


<div class="group flex items-baseline mb-3  ">

    <span class="text-xl font-semibold me-2  ">  Choice Status :</span>  
     <span class="uppercase border rounded px-2 py-0.5 {{$team->choice ? 
     'bg-slate-50 text-success' : 'bg-red-100 text-danger'}}"
        > {{$team->choice ? "Done" : "Not yet"}} 
    </span>

</div>
@if ($team->assignedSubject)
<div class="group  bg-slate-50 border-l-4 border-success p-4 rounded  ">

    <p class="text-xl  font-semibold whitespace-nowrap mb-2 ">  Assigned Subject :</p>  
     <p class="uppercase text-success "> {{$team->assignedSubject?->title }} 
     </p>
</div>
@else
       <div class="group  bg-gray-50 border-l-4 border-danger p-4 rounded  ">

    <p class="text-xl  font-semibold whitespace-nowrap mb-2 ">  Assigned Subject :</p>  
     <p class="uppercase text-danger "> No subject has been assigned yet.
     </p>

</div> 
@endif


</div>

</div>


