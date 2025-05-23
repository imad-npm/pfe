@props(["route"=>'','text'=>''])

<a {{$attributes->merge(["class"=>"rounded-md 
flex px-4 py-2  whitespace-nowrap font-medium text-[0.94rem]  h-fit bg-primary text-white
 border border-success"])}} 
href="{{$route}}"
><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
  </svg>
  {{$text}}</a>
