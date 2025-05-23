  <x-alert.success />  
<div class="rounded-md bg-white shadow-lg p-5">

<h3 class="mb-2 text-3xl border-b-2 pb-2 font-semibold p-2">Subject Assignment Process  </h3>

   <div class="mt-5">
    
    <div class="mb-5">  
        <h3 class="font-semibold text-lg mb-1">Auto Assignment</h3>
      <p class="  mb-4">This will automatically assign to 
        each team the first available subject from their preference list 
        (in order), based on their ranking (highest average first). 
      </p>
      <a class="rounded-md  py-2 px-5 mt-2 font-medium border text-white
       bg-primary  " 
      href="{{route('admin.assignments.assign')}}">
      Run Assignment Process        </a>  
</div>


<div class="mb-4">
    <h3 class="font-semibold text-lg mb-1">Start New Session</h3>
    <p class="  mb-4">
        This will delete all choices from teams that were not assigned a subject.
         </p>
         <a class="rounded-md   py-2 px-5 mt-2 font-medium border text-white
       bg-primary " 
href="{{route('admin.assignments.new-session')}}">
New Session       </a>   

</div>
  
<div class="mb-4">
    <h3 class="font-semibold text-lg mb-1">Reset Assignments</h3>
    <p class="  mb-4">
        This will remove all current subject assignments from teams 
        and mark all subjects as available again. No team will remain linked to a subject. 
    </p>
<a class="rounded-md  py-2 px-5 mt-2 font-medium border text-white
       bg-danger " 
href="{{route('admin.assignments.reset')}}">
Reset Assignments    </a>   
  
</div>

</div>

</div>