@props(['options'=>[],'name'=>"","label"=>"","selected_id"=>""])

@php


    if(!empty($selected_id) && !empty($options)){
    $option=collect($options)->firstWhere('id',$selected_id) ;
    $selected_value=$option ? $option['value'] : "" ;  
    }
@endphp

<x-input-text :label="$label" {{$attributes}}  list="{{$name}}_list" 
value="{{$selected_value?? ''}}" 
id="{{$name}}_input" 
placeholder="Search or choose from the list" />
<datalist id="{{$name}}_list">
    @foreach ($options as $option)
    <option data-id="{{$option['id']}}" value="{{$option['value']}}">
       {{$option['value']}}
    </option>
   
    @endforeach
</datalist>

<input type="text" hidden  id="{{$name}}_selected" value="{{$selected_id}}"
 name='{{$name}}'' >

@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror

<script>
document.addEventListener('DOMContentLoaded', function () {
    let input = document.getElementById("{{$name}}_input");
    let selected = document.getElementById("{{$name}}_selected");
    let datalist = document.getElementById("{{$name}}_list");
    let options = datalist.querySelectorAll("option"); 

    input.addEventListener('input', function () {
        let found=false ;
        if(input.value==""){
            selected.value=""
            input.setCustomValidity('')

            return
        }
        for ( let  element of options) {
            if (element.value.trim() === input.value.trim()) {
                found=true ;
                selected.value = element.getAttribute("data-id");
                break
            }   
 
        };  
        if(found )
                        input.setCustomValidity('')

        else{
                    selected.value=""
                   input.setCustomValidity('Please select a valid option from the list.')

        }
    });
});

</script>