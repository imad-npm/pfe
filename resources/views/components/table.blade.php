
@props(['columns'=>[],"actions"=>true])

<div class="rounded-lg  bg-white border  shadow-md mb-5 mt-5  w-[99%] overflow-hidden">
<table class=" w-full">
<thead>   <tr class="bg-slate-100  ">
    @foreach ($columns as $column)
 
        <th class="py-3 px-2 ">{{$column}}</th>
     
    @endforeach 
 
    @if ($actions)
         <th>Actions</th>
    @endif
    
  </tr>
</thead>
<tbody>
  {{$slot}}
</tbody>

</table></div>