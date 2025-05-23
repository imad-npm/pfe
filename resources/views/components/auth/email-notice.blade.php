
@props(['route'=>'' ,'email1'=>null,"email2"=>null])


<div class=" p-8 rounded-lg border shadow-lg   w-[90%] 
md:w-1/2 mt-16 mx-auto ">

<h2 class="font-semibold mb-4 text-2xl">Verify your email address</h2>

<div class="text-lg mb-5">
    <p class="  ">
        We've sent a verification email to 
        <span class="text-blue-700">  {{$email1?? ""}}</span>
        <span class="ms-3 text-blue-700">  {{$email2?? ""}}</span>

    </p>
    <div class="mb-3">
        Please check your inbox and follow the instructions to
         verify your email address. 
         <div class="">
         Note that the link is valid for <span class="text-blue-700">1 hour</span>
        </div>
    </div>


 </div>  
    <a class="bg-primary text-white font-medium px-4 py-2 rounded-md" 
    href="{{$route}}">
    Resend Email</a></p>    
</div>
