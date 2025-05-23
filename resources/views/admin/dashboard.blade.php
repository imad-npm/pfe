


@extends('layouts.app')
@section('content')

<div class="ps-6 grid gap-6 grid-cols-3 ">

<div class="mb-6 col-span-2">

<h3 class="mb-3 text-3xl font-semibold p-2">General Stats</h3>

<div class=" grid grid-cols-2 gap-5 ">

   <div class="p-5  bg-white border shadow mb-5 rounded-xl " >
   <h4 class="mb-3 text-2xl font-semibold pb-2 border-blue-900   border-b-2">Students</h4>
   <div class="font-semibold p-3 text-4xl "> {{$students['total']}}
     </div>
     <div class="flex gap-3">
      @foreach ($specialities as $speciality)
        <div>{{ $speciality->abbreviation }} :<span class="font-semibold ">
     {{ $students["bySpeciality"][$speciality->abbreviation] }}</span>
      </div>
   
      @endforeach
  
  </div>

  <div class=" flex gap-3">
    <div>With Team :<span class="font-semibold">
      {{ $students["withTeam"] }}  </span> </div>
      <div>Without Team :<span class="font-semibold">
        {{ $students["withoutTeam"] }}  </span> </div>
  </div>
  
</div>

<div class="p-5  bg-white border shadow mb-5 rounded-xl " >
   <h4 class="mb-3 text-2xl font-semibold pb-2 border-primary   border-b-2">Teachers</h4>
   <div class="font-semibold p-3 text-4xl "> {{$teachers['total']}}
     </div>
     <div class="flex gap-3">
   <div>Internals :<span class="font-semibold "> {{$teachers['internal']}}</span>  </div>
   <div>Externals :<span class="font-semibold"> {{$teachers['external']}}</span>  </div>
</div>
</div>

<div class="p-5  bg-white border shadow mb-5 rounded-xl " >
   <h4 class="mb-3 text-2xl font-semibold pb-2 border-primary   border-b-2">Subjects</h4>
   <div class="font-semibold p-3 text-4xl "> {{$subjects['total']}}
     </div>
     <div class="flex gap-3">
      @foreach ($specialities as $speciality)
      <div>{{ $speciality->abbreviation }} :<span class="font-semibold ">
   {{ $subjects["bySpeciality"][$speciality->abbreviation] ?? "" }}</span>
    </div>
 
    @endforeach
     </div>
     <div class="flex gap-3 mt-2">
   <div>Assigned :<span class="font-semibold">{{$subjects['assigned']}}  </span> </div>
   <div>Not Assigned :<span class="font-semibold">{{$subjects['notAssigned']}}  </span> </div>
</div>

</div>


<div class="p-5  bg-white border shadow mb-5 rounded-xl " >
   <h4 class="mb-3 text-2xl font-semibold pb-2 border-primary   border-b-2">Teams</h4>
   <div class="font-semibold p-3 text-4xl "> {{$teams['total']}}
     </div>
     <div class="flex gap-3">
      @foreach ($specialities as $speciality)
      <div>{{ $speciality->abbreviation }} :<span class="font-semibold ">
   {{ $teams["bySpeciality"][$speciality->abbreviation] }}</span>
    </div>
 
    @endforeach  </div>
     <div class="flex gap-3 mt-2">
   <div>Assigned :<span class="font-semibold">{{$teams['assigned']}}  </span> </div>
   <div>Not Assigned :<span class="font-semibold">{{$teams['notAssigned']}}  </span> </div>
</div>
<div class="flex gap-3 mt-2">
  <div>One Member : <span class="font-semibold">{{$teams['oneMember']}}  </span> </div>
  <div>Two Members : <span class="font-semibold">{{$teams['twoMember']}}  </span> </div>
</div>

</div>

</div>
<div class="my-6 ">
 @include('admin.partials.assign')

</div>

</div>

<div class="col-span-1 px-3">

<div class="mb-6">
  <x-dates.card :choiceDate="$importantDates['choice']" 
  :proposalDate="$importantDates['proposal']" />

</div>


</div>

</div>

@endsection
                   