
@extends('layouts.app')

@section('content')
    
@php
    $columns=['id','title','supervisor',
    'co_supervisor','is assigned','specialities']
@endphp


<div class=" ps-6 mb-5 w-full ">
    <h3 class="text-4xl font-bold mb-5 ">Subjects</h3>

    <x-speciality.nav :route="route('admin.subjects.index')" 
    :currentSpeciality="$speciality" :specialities="$specialities" />

<div class="flex justify-between mt-6 px-3 ">
   <x-search-with-filters :route="isset($speciality ) ? route('admin.subjects.index',[$speciality])
   : route('admin.subjects.index')" >

<div class="">
    
    <span class="font-semibold">status</span>
<x-select name="status" :options="['all'=>'all','assigned'=>'assigned',
'not assigned'=>'not assigned']"
:selectedValue="request('status','all')" />

</div>


   </x-search-with-filters>

   <div class="flex gap-3">
    <x-button.delete text="Delete All " 
    :route="route('admin.teams.destroy-all')"
    class="bg-danger text-white rounded-md px-4 py-2 h-fit"
     />
   <x-button.export :route="route('admin.subjects.export',request()->query())">
    Subjects
       </x-button.export>

<x-button.create text="add subject" :route="route('admin.subjects.create')" />
  
   </div>

</div>


<x-table :columns="$columns" >

    
    @foreach ($subjects as $subject)
        <x-table.tr>
                <x-table.td>{{$subject->id}}</x-table.td>
                <x-table.td>{{
                Str::limit($subject->title,50)
                }}

                </x-table.td>
                <x-table.td>
                {{$subject->supervisor?->fullName}}
                <a class="text-primary underline text-sm" 
                href="{{route('admin.teachers.index',
                ['search'=>$subject->supervisor->fullName])}}">
                   Details
                </a> 
                </x-table.td>
                <x-table.td>
                    @if ($subject->coSupervisor)
                       {{$subject->coSupervisor?->fullName}}
                       <a class="text-primary underline text-sm" 
                       href="{{route('admin.teachers.index',
                       ['search'=>$subject->coSupervisor->fullName])}}">
                          Details
                       </a>     
                    @endif
               
                </x-table.td>

                <x-table.td>
                    @if ($subject->is_assigned)
                 <!--   <span class="  bg-green-100 justify-center text-sm 
                     border rounded py-0.5 px-1.5  text-success">
                       assigned</span>  
                 -->   <a class="text-primary underline" 
                 href="{{route('admin.teams.index',
                 ['search'=>$subject->title])}}">
                    Team
                 </a>        
                    @else
                    <span class="   
                    text-danger ">
                   <svg xmlns="http://www.w3.org/2000/svg" 
                   fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                   stroke="currentColor" class="size-8 ">
                       <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                    </span>
                    @endif
                
    
                    </x-table.td>
                    <x-table.td>
                        @if ($subject->speciality1)
                         <x-speciality.badge >
                            {{$subject->speciality1->abbreviation}}
                        </x-speciality.badge>   
                        @endif
                        @if ($subject->speciality2)
                         <x-speciality.badge >
                            {{$subject->speciality2->abbreviation}}
                        </x-speciality.badge>   
                        @endif

                        @if ($subject->speciality3)
                        <x-speciality.badge >
                           {{$subject->speciality3->abbreviation}}
                       </x-speciality.badge>   
                       @endif
                       

                    </x-table.td>
          
            <x-table.td>
                <div class="flex gap-2  ">
                <x-table.edit-btn :route="route('admin.subjects.edit',$subject->id)" />
                 <x-table.show-btn  :route="route('subjects.show',$subject->id)" />   
                <x-table.delete-btn :route="route('admin.subjects.destroy',$subject->id)" />
                
                </div>
            </x-table.td>
        </x-table.tr>
    @endforeach

</x-table>

<div class="mt-3 w-1/2">
    {{ $subjects->links() }}  </div>

@endsection

</div>