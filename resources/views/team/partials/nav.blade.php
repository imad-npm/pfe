
@php

    function setActive($name) {
      
      // dd($name,request()->url(),) ;
      //  if(str_contains(request()->url(),$name) )
        if(request()->is("*$name") )

        return 'text-primary ' ;
        return '' ;
    }
@endphp

<header class="mb-5 relative min-h-10 p-4 md:p-3  mx-3 border rounded-xl shadow
  font-medium bg-white
  ">
   
    <ul class="hidden md:flex justify-around  gap-3
       ">
      
        <li class="{{setActive('dashboard')}}">
            <a href="{{route('team.dashboard')}}">Dashboard</a>
        </li> 
         <li class="{{setActive('subjects')}}">
            <a href="{{route('subjects.index')}}">Subjects</a>
</li>
        <li class="{{setActive('profile')}}">
            <a href="{{route('team.profile')}}">Profile</a>
        </li>

        <li class="{{setActive('create')}}">
            <a href="{{route('team.choices.create')}}">Make Choice

            </a>
        </li>
        <li class="{{setActive('choices/show')}}">
            <a href="{{route('team.choices.show')}}">My Choices</a>
        </li>

        <li class="{{setActive('contact/show')}}">
            <a href="{{route('team.contact.show')}}">Contact </a>
        </li>


        <li><a class=" rounded-md py-1 px-3 text-danger text-danger"
            href="{{route('team.logout')}}">
            Logout</a>
           </li>     
    </ul>  

     <button id="menu-btn" class=" md:hidden absolute right-3 top-2">  
         <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
     <path d="M4 6h16M4 12h16M4 18h16"/>
   </svg>
</button>

   <ul id="mobile-menu" class=" flex mt-3 flex-col hidden md:hidden  py-3 gap-3
    ">
     <li class="{{setActive('dashboard')}}">
        <a href="{{route('team.dashboard')}}">Dashboard</a>
    </li>
    <li class="{{setActive('subjects')}}">
        <a href="{{route('subjects.index')}}">Subjects</a>
</li>
   
    <li class="{{setActive('profile')}}">
        <a href="{{route('team.profile')}}">Profile</a>
    </li>

    <li class="{{setActive('create')}}">
        <a href="{{route('team.choices.create')}}">Make Choice

        </a>
    </li>
    <li class="{{setActive('choices/show')}}">
        <a href="{{route('team.choices.show')}}">My Choices</a>
    </li>

    <li class="{{setActive('contact/show')}}">
        <a href="{{route('team.contact.show')}}">Contact </a>
    </li>

    <li><a class=" rounded-md py-1 px-3 text-danger text-danger"
         href="{{route('team.logout')}}">
         Logout</a>
        </li>
 
</ul>


</header>

<script>
    var btn=document.getElementById('menu-btn')
    var menu=document.getElementById('mobile-menu')
    btn.onclick=function () {
        menu.classList.toggle('hidden')
    }
</script>