@props(['options'=>[],'name'=>"","label"=>"","selectedValue"=>""])

<div >
    @if (!empty($label))
        <label for="{{$name}}" class="block  text-sm font-[560] mb-2">{{$label}}:</label>

    @endif

<select name="{{$name}}" id="{{$name}}" {{$attributes->merge(['class' => 
'border-gray-300 focus:border-slate-500 focus:ring-slate-500 bg-slate-50 rounded-md shadow-sm']) }}>
 <option {{ !empty($selectedValue) ? "" : 'selected' }} value="">Select</option>
    @foreach ($options as $key => $value)
     <option @if ($selectedValue==$key)
         selected
     @endif     value="{{$key}}">
        {{$value}}
     </option>
 @endforeach
</select>

</div>