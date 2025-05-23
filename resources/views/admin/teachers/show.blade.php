@extends('layouts.app')


@section('content')
    
<div class="w-[90%] bg-white my-10 md:w-1/2 mx-auto   rounded-lg border 
 shadow-lg shadow-gray- p-5 md:p-7">
    <div class="  mb-5  
   border-b-2  p-3 flex gap-3">
  
   <svg class="w-16 h-16 text-gray-600 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
    <path fill-rule="evenodd" d="M12 20a7.966 7.966 0 0 1-5.002-1.756l.002.001v-.683c0-1.794 1.492-3.25 3.333-3.25h3.334c1.84 0 3.333 1.456 3.333 3.25v.683A7.966 7.966 0 0 1 12 20ZM2 12C2 6.477 6.477 2 12 2s10 4.477 10 10c0 5.5-4.44 9.963-9.932 10h-.138C6.438 21.962 2 17.5 2 12Zm10-5c-1.84 0-3.333 1.455-3.333 3.25S10.159 13.5 12 13.5c1.84 0 3.333-1.455 3.333-3.25S13.841 7 12 7Z" clip-rule="evenodd"/>
  </svg>
  
  
  
   <div>
   <div class="text-3xl font-semibold"> {{$teacher->fullName}}
</div>
<span class="text-xl text-secondary font-medium">Teacher</span>
</div>

 </div>
    <div class=" ">
        
        <div class="mb-5  ">
             <p class="font-medium text-lg  w-1/3">Email</p>
            <p class="w-2/3 text-primary"> {{$teacher->email}}</p>
            </div>
        <div class="mb-5  ">
             <p class="font-medium text-lg  w-1/3">Rank</p>
             <p class="w-2/3">{{$teacher->rank}}</p>
            </div>
        <div class="mb-5  ">
             <p class="font-semibold text-lg  w-1/3">Institution</p>
        <p class="w-2/3">    {{$teacher->institution}}</p> 
            </div>

            @if ($teacher->addedBy)
                
            <div class="mb-5  ">
                <p class="font-semibold text-lg  w-1/3">Added By</p>
           <p class="w-2/3">    {{$teacher->addedBy?->fullName}}</p> 
               </div>
            @endif

            <div class="py-5 border-t-2">
                <a class="text-primary underline" href="{{route('admin.subjects.index'
                ,['search'=>$teacher->fullName])}}" >All Related Subjects to 
                {{$teacher->fullName}}</a>
            </div>

    </div>
</div>
@endsection