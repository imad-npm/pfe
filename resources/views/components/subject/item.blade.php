@props(['subject'=>null])


<div class="p-6 md:p-7 mb-10 rounded-lg shadow-lg  border
  bg-white w-[93%] md:w-[70%] mx-auto">
    <div class="mb-4">
        <h5 class="font-bold text-2xl break-words"> {{$subject->title}}</h5>
        </div>  
     
         <div class="mb-2">
            <h5><span class="font-semibold "><svg xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-6 inline me-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>Supervisor :</span>
                <span class=""> 
                     {{$subject->supervisor?->fullName}} 
                </span>
                <a href="{{route('teachers.show',$subject->supervisor->id)}}"
                    class="mx-3 text-primary text-sm underline">Details</a></h5>

         </div> 
         @if (isset($subject->coSupervisor))   
         <div class="mb-2">
            <h5><span class="font-semibold "><svg xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                class="size-6 inline me-1">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>Co Supervisor :</span> 
                <span class=""> 
                 {{$subject->coSupervisor?->fullName}} 
                </span>
                 <a href="{{route('teachers.show',$subject->coSupervisor->id)}}"
                    class="mx-3 text-primary text-sm underline">Details</a></h5>
         </div> 
         @endif
         
         <div class="mb-4  ">
            <span class="font-semibold  me-2">Specialities  </span>
           
            @for ($i = 1; $i < 4; $i++)
            @if ($speciality=data_get($subject,"speciality$i"))
            <x-speciality.badge>
            {{$speciality->abbreviation}}
            </x-speciality.badge>
       @endif
           
        @endfor
               </div> 

               <div class="mb-4">
                  <p class="line-clamp-2 ">
                     
                     {!!Str::limit( $subject->description,200) !!}
                  </p>
                </div>  
      
<div class="border-t-2 pt-5">
         <a  href="{{route('subjects.show',$subject->id)}}"
            class="py-3 px-6  font-medium rounded-md bg-primary text-white">
            Subject Details
            <svg class="ml-1 h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 12h-10.5m0 0L10.5 8.25M6.75 12l3.75 3.75"></path></svg>
         </a>
</div>

</div>