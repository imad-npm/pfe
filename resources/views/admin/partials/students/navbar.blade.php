@php
    use App\Models\Speciality;
@endphp

<nav>
<ul class="flex gap-8 justify-center">
    <li class="{{$speciality == null ? 'text-danger' : ''}}">
         <a href="{{route('admin.students.index')}}">All</a>
         </li>
    <li class="{{$speciality == Speciality::IAA ? 'text-danger' : ''}}">
         <a href="{{route('admin.students.index',[{{ \App\Constants\Speciality::IAA }}])}}">{{ \App\Constants\Speciality::IAA }}</a>
         </li>
    <li class="{{$speciality == Speciality::SID ? 'text-danger' : ''}}">
        <a href="{{route('admin.students.index',[{{ \App\Constants\Speciality::SID }}])}}">{{ \App\Constants\Speciality::SID }}</a>
    </li>
    <li class="{{$speciality == Speciality::RSID ? 'text-danger' : ''}}">
        <a href="{{route('admin.students.index',[{{ \App\Constants\Speciality::RSID }}])}}">{{ \App\Constants\Speciality::RSID }}</a>
    </li>

</ul>
</nav>