
@extends('layouts.app')



@section('content')


<x-table :columns="['id','type','start','end']" >  

@foreach ($dates as $date)
 <x-table.tr>

 <x-table.td> {{$dates->id}}</x-table.td>   
 <x-table.td> {{$dates->type}}</x-table.td>  
 <x-table.td> {{$dates->start}}</x-table.td>  
 <x-table.td> {{$dates->end}}</x-table.td>      
 
</x-table.tr>   
@endforeach

</x-table>

@endsection