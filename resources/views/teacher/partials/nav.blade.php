

@php
    $active="text-primary  "
@endphp
<header class="mb-8 min-w-[600px]  px-3 py-1">
    <ul class="flex justify-around font-medium text-gray-900 bg-white p-3 
     border rounded-xl shadow">

        <li class="{{request()->is('*dashboard') ? $active : '' }}">
            <a href="{{route('teacher.dashboard')}}">Dashboard</a>
      
        </li>

        <li class="{{request()->is('subjects*') ? $active : '' }}">
            <a href="{{route('subjects.index')}}">All Proposed Subjects</a>
      
        </li>
        <li class="{{request()->is('teacher/subjects') ? $active : '' }}">
            <a href="{{route('teacher.subjects.index')}}">My Subjects</a>
        </li>
        <li class="{{request()->is('*profile') ? $active : '' }}">
            <a href="{{route('teacher.profile')}}">Account </a>
        </li>
        
        <li class="{{request()->is('*external*') ? $active : '' }}">
            <a href="{{route('teacher.teachers.index')}}">External teachers  </a>
        </li>

        <li class="{{request()->is('*contact*') ? $active : '' }}">
            <a href="{{route('teacher.contact.show')}}">Contact </a>
        </li>
      
            
        <li class="ms-3 rounded-md py-1 px-3 text-danger text-danger">
                    <a href="{{route('teacher.logout')}}">Logout</a>
</li>
    </ul>
</header>