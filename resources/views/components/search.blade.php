
@props(['route'=>""])

<form action="{{$route}}" 
{{$attributes->merge(['class'=>"flex h-full min-w-[350px] md:w-1/2"])}}
 method="get">

    <x-input-search placeholder="Search....." name="search" />
    {{$slot}}
    <button class="rounded-md flex  items-baseline text-[0.94rem]
     bg-primary text-white rounded py-2 px-4 mx-2" >
        <svg class="size-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
        </svg><span class=""> Search</span></button>
</form>
