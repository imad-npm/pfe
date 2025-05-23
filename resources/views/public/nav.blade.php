
<header class="mb-5 relative min-h-10 flex flex-col md:flex-row md:flex-row p-4 md:p-3  mx-3 border rounded-xl shadow
font-medium bg-white
">

<div class="w-full md:w-[30%] relative  mx-5 md:mx-10" >
        <a href="/" class=" font-bold text-primary text-xl leading-tight">{{config('app.name')}}</a>

     <button id="menu-btn" class=" md:hidden absolute right-6 top-1/2 -translate-y-1/2">  
        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
       viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
    <path d="M4 6h16M4 12h16M4 18h16"/>
  </svg>
</button>

</div>
    <ul class="hidden md:flex justify-around w-full   gap-3
       ">
      
      <li class="">
        <a @class([ 'text-primary' => request()->routeIs('subjects.index')]) 
          href="{{route('subjects.index')}}">Subjects</a>
    </li> 
      <li class="">
        <a href="{{url('/#dates')}}">Important Dates</a>
    </li> 
      <li class="">
        <a href="{{url('/#contact')}}">Contact</a>
    </li> 
  
            
    </ul>  

   <ul id="mobile-menu" class=" flex items-start mt-3 
   flex-col hidden md:hidden  py-3 gap-3
    ">
    
      <li class="">
          <a @class([ 'text-primary' => request()->routeIs('subjects.index')]) href="{{route('subjects.index')}}">Subjects</a>
      </li> 
      <li class="">
        <a href="{{url('/#dates')}}">Important Dates</a>
    </li> 
      <li class="">
        <a href="{{url('/#contact')}}">Contact</a>
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