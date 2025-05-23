
@props(['route'=>""])

<form action="{{$route}}" 
{{$attributes->merge(['class'=>" relative  bg-white pt-5 pb-2 px-5 rounded-md shadow
 min-w-[350px] md:w-[50%] me-5 "])}}
 method="get">
    <div class="    ">

      <div class=" mb-2">
        <x-input-search  placeholder="Search....." name="search" />

        </div>  
    <div class="flex justify-between flex-wrap items-end gap-2 mb-2 ">
        {{$slot}}

          <button class="rounded flex ml-auto  items-baseline
        bg-primary text-white h-fit rounded py-2 px-4 text-[0.94rem] " >
           <svg class="size-4  me-2" aria-hidden="true" 
           xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
               <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
           </svg><span class=""> Search</span>
         </button>
    </div>
 <div class="flex ">
  
        </div>
        
    </div>

  
</form>
