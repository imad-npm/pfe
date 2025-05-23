@extends('layouts.app')

@section('content')
    

<x-errors />

<div class="mt-5 ps-5">

<div class="flex justify-between pe-3 ">
<x-search :route="route('teacher.teachers.index')" />

<x-button.create text="External" :route="route('teacher.teachers.create')" />

</div>

<x-table :columns="['id','firstname','lastname','email','rank','institution']" >

    @foreach ($teachers as $teacher)
        <x-table.tr>
                <x-table.td>{{$teacher->id}}</x-table.td>
                <x-table.td>{{$teacher->firstname}}</x-table.td>
                <x-table.td>{{$teacher->lastname}}</x-table.td>
                <x-table.td>{{$teacher->email}}</x-table.td>
                <x-table.td>{{$teacher->rank}}</x-table.td>
                <x-table.td>{{$teacher->institution}}</x-table.td>

            <x-table.td>
                <div class="flex gap-2  ">
                <x-table.edit-btn :route="route('teacher.teachers.edit',[$teacher->id])" />

                <x-table.delete-btn :route="route('teacher.teachers.destroy',$teacher->id)" />
                </div>
            </x-table.td>
        </x-table.tr>
    @endforeach

</x-table>

<div class="mt-3 w-1/2">
    {{ $teachers->links() }}  </div>


</div>   
@endsection

