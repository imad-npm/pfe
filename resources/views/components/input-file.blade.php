@props(['name' => '', 'label' => '', 'value' => '','placeholder'=>null] )

<label for="{{$name}}" class="block   text-sm font-[550] mb-2">{{$label}}:</label>
<input {{$attributes->merge()}} type="file" name="{{$name}}" id="{{$name}}" 
value="{{ $value }}"
       class="  file:border-0 file:outline-0 file:shadow file:px-3 file:py-2 file:bg-slate-100
        file:text-primary file:rounded  file:border-slate-200  
       rounded w-full py-2 px-3  leading-tight
        focus:outline-none focus:shadow-outline"
       placeholder="{{$placeholder ?? $label}}..." />
@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror