

<div class=" w-[90%] md:w-1/2  mx-auto bg-white p-4 shadow-lg border rounded ">

<h3 class="text-3xl mb-3 font-semibold bg-gray-900 text-white rounded p-3">
    Teacher Info</h3>

    <div class="p-2">

<div class="group mb-3">

    <div> <span class=" font-semibold me-2"> Full name 
        </span>{{$teacher->firstname}} {{$teacher->lastname}} 
    </div>
</div>
        <div class="group mb-3">
        <div> <span class=" font-semibold me-2 "> Email </span> {{$teacher->email}}  </div>

        </div>

<div class="group flex items-baseline mb-3  ">

    <span class=" font-semibold me-2 "> Rank :</span>  
     <p class="uppercase "> {{$teacher->rank}}</p>

</div>


<div class="group flex items-baseline mb-3  ">

    <span class=" font-semibold me-2 ">  Institution :</span>  
     <p class="uppercase ">{{$teacher->institution}}</p>

</div>
    </div>



</div>


