
@extends($layout)

@section('content')
    

<div class="w-[90%] mx-auto md:w-[80%] bg-white my-10 p-5 md:p-10 bg-white
 shadow-lg border rounded-lg ">

 <div class="border-b-2 pb-5 ">
    <h2 class=" text-3xl  font-semibold">{{$subject->title}}</h2>
    @if ($subject->tags)
    <div class="mt-4 ">
   <!--<span class=" font-semibold  text-xl me-3 "> tags :</span>
   -->@foreach (explode(',',$subject->tags) as  $tag)
       <span class="py-1 px-2 rounded-md  bg-slate-50
        font-semibold text-secondary border border-gray-300  ">
         #{{$tag}}</span>
   @endforeach
        
       
</div> 
@endif
</div>

    <div class=" border-b-2 py-5  ">
        <span class=" font-semibold text-xl  me-3 "> Specialities :</span>

        @for ($i = 1; $i < 4; $i++)
            @if ($speciality=data_get($subject,"speciality$i"))
                 <span class="py-0.5 px-3 rounded-md bg-blue-100 font-medium text-primary border border-gray-300  uppercase">
                 {{$speciality->abbreviation}}</span>
            @endif
           
        @endfor
            
            
    </div>
    <div class="mb-3 border-b-2 py-5 ">
        <h2 class="text-xl font-semibold ">Supervisors</h2>

        <div class="md:flex mt-2 justify-between">
        <div>
        <span class=" font-semibold me-3 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
              class="size-6 inline">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
          </svg>
           Supervisor :</span>
        <span class=""> 

        {{$subject->supervisor?->fullName}} 

        </span>
        <a href="{{route('teachers.show',$subject->supervisor->id)}}"
            class="mx-2 text-primary text-sm underline">Details</a></h5>
        </div>
   @if (isset($subject->coSupervisor))
    <div class="mb-3 ">
        <span class=" font-semibold  me-3 "><svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6 inline">
           <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
         </svg> Co Supervisor :</span>
        <span class=""> 

        {{$subject->coSupervisor?->fullName}}
        </span> 
        <a href="{{route('teachers.show',$subject->coSupervisor->id)}}"
            class="mx-2 text-primary text-sm underline">Details</a></h5>
    </div>
    @endif 
</div>

</div>
    
  
    <div class="my-5">            
        <h2 class="text-xl font-semibold ">Description</h2>

        <div class="break-lines break-words my-3  prose   ">
            {!! $subject->description !!}
        </div>

      
      
    </div>
</div>
@endsection