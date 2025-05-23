@props(['name' => '', 'placeholder'=>""])

<input type="text" name="{{$name}}" id="{{$name}}" 
       value="{{request('search')}}"
     {{$attributes->merge(["class"=>"  appearance-none border bg-gray-50
       shadow-sm border-gray-300 rounded-md w-full py-2 px-3  
       leading-tight focus:outline-none focus:shadow-outline"])}}  
       placeholder="{{$placeholder}}" />
@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>

@enderror