
  @extends($layout)  



@section('content')

<div class="mt-5 ps-5 ">
<x-search :route="isset($speciality )
 ? route('subjects.index',[$speciality])
   : route('subjects.index')"
   class="mx-auto"
   />
   <x-speciality.nav :route="route('subjects.index')" 
   :currentSpeciality="$speciality" :specialities="$specialities" />

@foreach ($subjects as $subject)
    <x-subject.item :subject="$subject" />
@endforeach

<div class="m-3 
md:w-1/2">
  {{ $subjects->links() }}  
</div>

</div>
@endsection