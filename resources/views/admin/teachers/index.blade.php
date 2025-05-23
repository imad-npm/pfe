@extends('layouts.app')

@section('content')

@php
    use App\Constants\TeacherType ;
@endphp
<div class=" ps-6 mb-5 w-full ">

<x-errors />

<h3 class="text-4xl font-bold mb-8 ">Teachers</h3>
<div class="flex justify-between mt-6 px-3 ">

<x-search-with-filters :route="route('admin.teachers.index')" >

    <div class=" ">
        <span class="font-semibold">type</span>
        <x-select class="w-34" name="type" 
        :options="[TeacherType::INTERNAL=>TeacherType::INTERNAL,
        TeacherType::EXTERNAL=>TeacherType::EXTERNAL]"
        :selectedValue="request('type')" />
    </div>
    
</x-search-with-filters>
<div class="flex gap-2">
    
    <x-button.export :route="route('admin.teachers.export')">
 external teachers
    </x-button.export>

<x-button.create text=" external "
 :route="route('admin.teachers.create',TeacherType::EXTERNAL)" />

 <x-button.create text=" internal "
 :route="route('admin.teachers.create',TeacherType::INTERNAL)" />

</div>
</div>

<x-table :columns="['id','firstname','lastname','email','rank',
'type','added by','institution','subjects']" >

    @foreach ($teachers as $teacher)
        <x-table.tr>
                <x-table.td>{{$teacher->id}}</x-table.td>
                <x-table.td>{{$teacher->firstname}}</x-table.td>
                <x-table.td>{{$teacher->lastname}}</x-table.td>
                <x-table.td>{{$teacher->email}}</x-table.td>
                <x-table.td>{{$teacher->rank}}</x-table.td>
                <x-table.td>
                        <span class="inline-block text-sm py-0.5 
                        border border-gray-800  px-2.5 rounded-md
                         
                         ">
                            {{$teacher->type}}
                        </span> 
 
                </x-table.td>

                <x-table.td>
                    {{
                        $teacher->addedBy?->fullName
                        }}
                </x-table.td>
                <x-table.td>{{Str::limit($teacher->institution,50)}}

                </x-table.td>

                <x-table.td>
 <a class="text-primary underline " 
                    href="{{route('admin.subjects.index',
                    ['search'=>$teacher->fullName])}}">
                       subjects
                    </a>  
                </x-table.td>
                
  
            <x-table.td>
                <div class="flex gap-2  ">
                 
                    <x-table.edit-btn :route="route('admin.teachers.edit',[$teacher->type,$teacher->id])" />
                    <x-table.show-btn 
                    :route="route('admin.teachers.show',$teacher->id)" />

                    <x-table.delete-btn :route="route('admin.teachers.destroy',$teacher->id)"
                        confirm="Deleting this teacher will also remove all subjects associated with them."
                        />
                </div>
            </x-table.td>
        </x-table.tr>
    @endforeach

</x-table>

<div class="mt-3 w-1/2">
    {{ $teachers->links() }}  </div>

</div>
@endsection

