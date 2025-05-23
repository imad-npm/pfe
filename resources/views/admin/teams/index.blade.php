
@extends('layouts.app')

@section('content')
    
<div class=" ps-6 mb-5 w-full ">

<x-errors />

<h3 class="text-4xl font-bold mb-5 ">Teams</h3>

<x-speciality.nav  :currentSpeciality="$speciality" :specialities="$specialities"
:route="route('admin.teams.index')"   />


    
<div class="flex -100 justify-between mt-6 pe-3">
    
   


<x-search-with-filters :route="isset($speciality ) ? 
route('admin.teams.index',[$speciality])   : route('admin.teams.index')" >

        <div class=" gap-1 items-center">
        <span class="font-semibold">status</span>
        <x-select  name="status" :options="['assigned'=>'Assigned',
        'not assigned'=>'Not Assigned']"
        :selectedValue="request('status')" />
    </div>

    <div class=" gap-1 items-center">
        <span class="font-semibold">type</span>
        
        <x-select class="w-34"  name="type" :options="['one member'=>'One member',
        'two members'=>'Two members']"
:selectedValue="request('type')" />
</div>

<div class=" gap-1 items-center">
    <span class="font-semibold ">choice</span>
    <x-select class="" name="choice" :options="['with_choice'=>'With Choice',
    'without_choice'=>'Without Choice']"
    :selectedValue="request('choice')" />
</div>

</x-search-with-filters>


<div class="flex  h-fit gap-5 flex-wrap justify-end ">
    <x-button.delete text="Delete All " confi
    :route="route('admin.teams.destroy-all')"
    class="bg-danger text-white rounded-md px-4 py-2 h-fit"
     />

           <a href="{{route('admin.teams.index',
           array_merge(request()->query(),['sort'=>1]))}}"
            class="border bg-secondary font-medium  
            text-white
            px-4 py-2 rounded-md text-[0.93rem]">  <svg xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
            class="size-6 inline">
             <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M12 17.25h8.25" />
           </svg>  Sort By Average
        </a>
<x-button.export  :route="route('admin.teams.export',request()->query() )">
    {{request('status') . " "}}
    Teams
        </x-button.export>

<x-button.create text="add team" :route="route('admin.teams.create')" />

</div>

</div>


<x-table :columns="['id','student 1','student 2','assigned subject' ,'max_average'
,'speciality','choice']" >

    @foreach ($teams as $team)
        <x-table.tr>
                <x-table.td>{{$team->id}}</x-table.td>
                <x-table.td>
                    {{$team->student1?->fullName}}
                    <a class="text-primary underline text-sm" 
                       href="{{route('admin.students.index',
                       ['search'=>$team->student1?->id])}}">
                          Details
                       </a>  
                </x-table.td>
                <x-table.td>
                    @if ($team->student2)
                       {{$team->student2?->fullName}}
                       <a class="text-primary underline text-sm" 
                       href="{{route('admin.students.index',
                       ['search'=>$team->student2?->id])}}">
                          Details
                       </a>   
                    @endif
                    
                </x-table.td>
                <x-table.td>
                    @if ($team->assignedSubject) 
                     <span class="font-medium text-success">
                      {{Str::limit($team->assignedSubject?->title,50)}}
                      </span>
                       <a class="text-primary underline text-sm" 
                    href="{{route('admin.subjects.index',
                    ['search'=>$team->assignedSubject?->title])}}">
                       Details
                    </a> 
                        
                    @else
                    <span class="   
                    text-danger ">
                   <svg xmlns="http://www.w3.org/2000/svg" 
                   fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                   stroke="currentColor" class="size-8 mx-auto">
                       <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                     </svg>
                    </span>
                    @endif
                 
                </x-table.td>
                <x-table.td>{{$team->max_average}}</x-table.td>

                <x-table.td>
                    @if ($team->speciality)
                    <x-speciality.badge >
                       {{$team->speciality->abbreviation}}
                   </x-speciality.badge>   
                   @endif
                </x-table.td>

                <x-table.td>
                    @if ($team->choice)
                    <a class="text-primary underline " 
                    href="{{route('admin.choices.show',[$team->choice?->id])}}">
                       Choice
                    </a>     
                     @else
                    <span class="   
                     text-danger ">
                    <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="currentColor" class="size-8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                     </span>
                    @endif
                </x-table.td>
             

            <x-table.td>
                <div class="flex gap-2  ">
                    @if (!$team->choice)
                    <x-table.edit-btn text='add choice'
                     :route="route('admin.choices.create').'?team_id='.$team->id" />
                    @endif
                    <x-table.edit-btn :route="route('admin.teams.edit',[$team->id])" />
                <x-table.delete-btn :route="route('admin.teams.destroy',$team->id)" />
                </div>
            </x-table.td>

        </x-table.tr>
    @endforeach

</x-table>

<div class="mt-3 w-1/2">
    {{ $teams->links() }}  </div>


</div>   
@endsection
