@props(['hasFiles'=>false,"action"=>""])

<div {{$attributes->merge(['class'=> "form-container
  mx-auto mt-14 mb-10  w-[86%] md:w-1/2"])}} >
    <x-errors /> 
    <x-alert.success />
    <form action="{{$action}}"  method="post" class="bg-white 
     border rounded-lg px-5 py-6 shadow-gray-200 shadow-lg" @if ($hasFiles)enctype="multipart/form-data" 
     @endif>
        @csrf
   
           {{$slot}} 
    </form>   

</div>    