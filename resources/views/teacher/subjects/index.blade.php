
@extends('layouts.app')

@section('content')
    
<div class=" ps-6 mb-5 w-full ">
    <h3 class="text-4xl font-bold mb-5 ">Subjects</h3>

    <x-speciality.nav :route="route('teacher.subjects.index')" 
    :currentSpeciality="$speciality" :specialities="$specialities" />

<div class="flex justify-between mt-6 px-3 ">
   <x-search-with-filters :route=" route('teacher.subjects.index')" >

<div class="">
    <span class="font-semibold">status</span>

<x-select name="status" :options="['all'=>'all','assigned'=>'assigned',
'not assigned'=>'not assigned']"
:selectedValue="request('status','all')" />
</div>


   </x-search-with-filters>

   <div class="flex gap-3">
  
<x-button.create text="add subject" :route="route('teacher.subjects.create')" />
  
   </div>

</div>


<x-table :columns="['id','title','decription','supervisor',
'co_supervisor','is assigned','specialities']" >

    
    @foreach ($subjects as $subject)
        <x-table.tr>
                <x-table.td>{{$subject->id}}</x-table.td>
                <x-table.td>{{
                    Str::limit($subject->title,100)
                    }}
    
                    </x-table.td>
                <x-table.td >{{  Str::limit( $subject->description,100)
        }}</x-table.td>
                <x-table.td>
                    {{$subject->supervisor?->fullName}}
                   
                    </x-table.td>
                    <x-table.td>
                        @if ($subject->coSupervisor)
                           {{$subject->coSupervisor?->fullName}}
                              
                        @endif
                   
                    </x-table.td>
                <x-table.td>
                    @if ($subject->is_assigned)
                 <!--   <span class="  bg-green-100 justify-center text-sm 
                     border rounded py-0.5 px-1.5  text-success">
                       assigned</span>  
                 -->   <a class="text-primary underline" 
                 href="{{route('teacher.teams.show',$subject->team->id)}}">
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
                <x-table.edit-btn :route="route('teacher.subjects.edit',$subject->id)" />
                 
                        <x-table.show-btn :route="route('subjects.show',$subject->id)" > 
                            show
                        </x-table-show-btn>
                <x-table.delete-btn :route="route('teacher.subjects.destroy',$subject->id)" />
                </div>
            </x-table.td>
        </x-table.tr>

    @endforeach

</x-table>

<div class="mt-3 w-1/2">
    {{ $subjects->links() }}  </div>

</div>
</div>
@endsection
