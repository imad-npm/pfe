@props(['name' => '', 'label' => '', 'value' => '','placeholder'=>null] )

<label for="{{$name}}" class="block   text-sm font-[550] mb-2">{{$label}}:</label>
<input {{$attributes->merge()}} type="text" name="{{$name}}" id="{{$name}}" 
value="{{ 
 $value }}"
       class="  appearance-none border shadow-sm border-gray-300
       bg-gray-50 rounded-md w-full py-2 px-3 leading-tight
        focus:outline-none focus:shadow-outline"
       placeholder="{{$placeholder ?? $label}}..." />
@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror