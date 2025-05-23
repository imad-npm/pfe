@props(['name' => '', 'label' => '', 'value' => ''])

<label for="{{$name}}" class="block  text-sm font-[550] mb-2">{{$label}}:</label>
<textarea type="text" name="{{$name}}" id="editor" 
{{$attributes->merge(['class'=>'"shadow appearance-none rounded-md bg-gray-50
 border border-gray-300 min-h-28
         w-full  leading-tight focus:outline-none
          focus:shadow-outline"'])}}
       
       placeholder="{{$name}}..." >{{ old($name, $value) }}</textarea>


@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror