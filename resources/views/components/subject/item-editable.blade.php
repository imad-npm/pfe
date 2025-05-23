@props(['subject'=>null])


<div class="p-6 mb-3 rounded shadow w-[330px] md:w-1/2 mx-auto">
    <div class="mb-2">
        <h5 class="font-semibold text-2xl break-words"> {{$subject->title}}</h5>
        </div>  
        <div class="mb-2">
           <p class="line-clamp-2">{{$subject->description}}</p>
         </div>  
         <div class="mb-2">
            <h5><span class="font-semibold text-lg">supervisor :</span>  {{$subject->supervisor?->firstname}} {{$subject->supervisor?->lastname}} 
              <span class="ms-3 font-semibold text-lg">rank: </span> {{$subject->supervisor?->rank}}</h5>
         </div> 
         <div class="mb-2">
            <h5><span class="font-semibold text-lg">co supervisor :</span>  {{$subject->coSupervisor?->firstname}} {{$subject->coSupervisor?->lastname}} 
               <span class="ms-3 font-semibold text-lg">rank: </span> {{$subject->coSupervisor?->rank}}</h5>
            </div> 
         <div class="mb-2  ">
            <span class="font-semibold text-lg">specialities : </span>
           
            <p class="inline me-2">{{$subject->speciality1}}</p> 
               <p class="inline me-2">{{$subject->speciality2}}</p>
                <p class="inline me-2">{{$subject->speciality3}}</p>
         </div> 
         <div class=" border-t-2 pt-2 flex gap-4">
            <a class="rounded p-2 bg-white text-primary"
             href="{{route("teacher.subjects.edit",$subject->id)}}">Edit</a>
            <x-button.delete class="rounded p-2 bg-red-100 text-danger"
            :route="route('teacher.subjects.destroy',$subject->id)"
             />
             <a  href="{{route('subjects.show',$subject->id)}}"
               class="p-2 rounded bg-gray-900 text-white">
               Subject Details
            </a>
         </div> 

         


</div>