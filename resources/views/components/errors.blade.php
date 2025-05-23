@props(['errors'=>[]])

  @if ($errors->any())
<div class="p-6 bg-red-50 rounded-md border border-red-100 m-4">

    <div class="flex gap-3 ">
       <div>
        <svg class="size-6  text-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94l-1.72-1.72z" clip-rule="evenodd" />
          </svg>
          </div>
          <div>
            <p class="text-danger font-medium mb-3">
            There were errors with your submission

            </p> 
            @foreach ($errors->all() as $error)
    <p class="text-danger">{{ $error }}</p>

@endforeach
          </div>
         
    </div>
  

</div>
@endif

