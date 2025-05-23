@php
    $active="text-primary "
@endphp

<div class="mb-8">
    <ul class="flex justify-around bg-white font-medium text-gray-800 p-3 shadow ">
        <li class="me-8 font-semibold text-lg">Admin Panel</li>
        <li class="{{request()->is('*dashboard') ? $active : ''}} "
        ><a href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>
        <li class="{{request()->is('*teams*') ? $active : ''}} ">
            <a href="{{route('admin.teams.index')}}">Teams</a>
        </li>
        <li class="{{request()->is('*students*') ? $active : ''}} ">
            <a href="{{route('admin.students.index')}}">Students</a>
        </li>
        <li  class="{{request()->is('*subjects*') ? $active : ''}} ">
            <a href="{{route('admin.subjects.index')}}">Subjects</a>
        </li>
        <li class="{{request()->is('*teachers*') ? $active : ''}} ">
            <a href="{{route('admin.teachers.index')}}">Teachers</a>
        </li>
        <li class="{{request()->is('*email*') ? $active : ''}} ">
            <a href="{{route('admin.emails-teacher.index')}}">
                 Teacher Emails List</a>
        </li>
        <li class="{{request()->is('*specialities*') ? $active : ''}} ">
            <a href="{{route('admin.specialities.index')}}">
                 Specialities</a>
        </li>
       
        
        <li class="ms-3 rounded-md py-1 px-3 text-danger text-danger">
            <a href="{{route('admin.logout')}}">logout</a>
        </li>

       


    </ul>
</div>