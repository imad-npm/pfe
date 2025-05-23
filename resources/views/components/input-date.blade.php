@props(['name' => '', 'label' => '', 'value' => ''])

<label for="{{$name}}" class="block  text-sm font-[560] mb-2">{{$label}}:</label>
<input {{$attributes->merge()}} type="datetime-local" name="{{$name}}"
 id="{{$name}}" 
 value="{{ $value }}"
 
       class="shadow appearance-none border
       shadow-sm border-gray-300 rounded-md
         w-full py-2 px-3  leading-tight focus:outline-none focus:shadow-outline"
       placeholder="{{$label}}..." />
@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror