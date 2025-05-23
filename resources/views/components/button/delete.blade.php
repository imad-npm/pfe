
@props(['route'=>"" ,"text"=>"Delete",'confirm'=>''])

<div x-data="{ open:false }">
    
    
  <form id="form" @submit.prevent="open=true" action="{{$route}}" method="POST">
      @csrf
      @method("Delete")
      <button type="submit" 
      {{$attributes->merge(['class'=>'text-danger text-[0.94rem] font-medium'])}}>{{$text}}</button>
  </form>
  
  <style>[x-cloak] { display: none !important; }</style>
  
  <div x-cloak x-show="open" id="modal" class="fixed top-0 left-0 h-full
  bg-black bg-opacity-50  w-full flex justify-center items-center
  z-50 ">  
  <div class=" w-full mx-6 md:w-1/3  md:mx-auto p-5 mt-10 bg-white overflow-y-auto                                     
             shadow-md flex justify-center rounded-md ">
  <div class="p-5">     
        <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
  
    <p class="mb-3 font-semibold text-xl text-center">Are you sure ?</p>
    <p class="mb-6 font-medium  text-center">{{$confirm}}</p>

  <div class="flex justify-center gap-3">
    <button id="confirm" @click="$el.closest('div[x-data]')
    .querySelector('form').submit()" type="button" class=" rounded-md px-4 py-2 
    border-danger text-danger border font-medium">Confirm</button>
    <button id="cancel" @click="open=false" type="button" class=" rounded-md 
    px-4 py-2 
    border-gray-800 border  font-medium">Cancel</button>
  </div>
  
  </div>
    
  </div>
  
  
  </div>
  </div>
  
  
  