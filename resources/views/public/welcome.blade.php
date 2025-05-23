@extends('layouts.guest')


@php
use App\Models\ImportantDate;

      $choiceDate = ImportantDate::where('type', 'choice')->first();
      $proposalDate = ImportantDate::where('type', 'proposal')->first();

@endphp
@section('content')
    


<section class="flex flex-col items-center py-3 mt-8 px-4 mb-14 md:px-10 justify-center
">
    <h1 class="text-5xl font-bold mb-5">Welcome to <span class="text-primary">
        {{config("app.name")}}</span></h1>
    <p class="text-lg ">Simplify the process of proposing, choosing, 
        and assigning final year projects for students and supervisors.
        </p>
</section>

<section class=" px-4 mb-14 md:px-10 py-3  ">
<h1 class="text-3xl font-bold text-center mb-6 ">Find Your Path</h1>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-white  rounded-lg shadow-lg p-7 shadow-gray-300
     border-t-4 border-primary">
        <div class="flex flex-col h-full ">

    <h3 class="text-2xl font-semibold text-primary font-bold mb-2">Team </h3>
    <p class="text-lg  mb-4">
        Register, choose your preferred subjects and view your assignment results.
        </p>
        <div class="mt-auto">
        <a href="{{route('team.register')}}" 
        class="rounded bg-primary text-white font-semibold px-4 py-2 me-3">
        Register
    </a>
    <a href="{{route('team.login')}}" 
        class="rounded bg-primary text-white font-semibold px-4 py-2">
        Login
    </a>
        </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg shadow-gray-300  p-7 
    border-t-4 border-primary">
        <div class="flex flex-col h-full ">

        <h3 class="text-2xl font-semibold text-primary  font-bold mb-2">Teacher </h3>
        <p class="text-lg  mb-4 h-[60%]">
            Propose and manage your subjects, add external teachers, and view all subject proposals and assignment results.        </p>
            
            <div class="mt-auto">
            <a href="{{route('teacher.register')}}" 
        class="rounded bg-primary text-white font-semibold px-4 py-2 me-3">
        Register
    </a>
    <a href="{{route('teacher.login')}}" 
        class="rounded bg-primary text-white font-semibold px-4 py-2">
        Login
    </a>
            </div>
        </div>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-7 shadow-gray-300
           border-t-4 border-secondary">
            <div class="flex flex-col h-full ">
<h3 class="text-2xl font-semibold text-secondary font-bold mb-2">
                Admin </h3>
            <p class="text-lg  mb-4 ">
                Access the full administration panel to manage students, teams, 
                subjects, and system settings.
            </p>
            <div class="mt-auto">
        <a href="{{route('admin.login')}}" 
            class="rounded bg-secondary text-white font-semibold px-4 py-2">
            Login
        </a>
    </div>
            </div>
            
            </div>
   </div>
</section>

<section class="mb-14" id="dates">
    <h1 class="text-3xl font-bold text-center mb-6">
        Stay updated on the key deadlines

    </h1>
    <div class=" mx-3 md:mx-6 ">
    <x-dates.card-horizontal class="shadow-lg shadow-gray-200"
    :proposalDate="$proposalDate" :choiceDate="$choiceDate" />
</div>
</section>

<section class="mb-14 text-center  ">
    <h1 class="text-3xl font-bold text-center mb-6">
        Explore Proposed Subjects

    </h1>

      <div class="bg-white rounded-xl shadow-lg p-8 
      flex flex-col items-center mx-auto md:w-[70%] border ">
           
<h3 class="text-2xl text-center font-semibold text-primary font-bold mb-6">
    View All Subjects
</h3>
            <p class="text-lg  mb-7 ">
                Browse through the comprehensive list of
                 available PFE subjects to find your ideal project.
            </p>
            <div class="mt-auto">
        <a href="{{route('subjects.index')}}" 
            class="rounded bg-primary text-white font-semibold
              text-lg px-6 py-3">
            Browse Subjects
            <svg class="ml-1 h-5 w-5 inline" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.25 12h-10.5m0 0L10.5 8.25M6.75 12l3.75 3.75"></path></svg>

                </a>
  
            </div>
            
            </div>
</section>

<section class="py-3  " id="contact">
    <h2 class="text-3xl font-semibold text-center mb-2">Need Help?</h2>
 <x-contact.form  :action="route('contact.submit')"/>
</section>

<footer class="bg-gray-100  p-6 text-gray-800 text-center text-gray-100 font-medium">
    &copy; 2025 PFE Manager. All rights reserved. &nbsp;|&nbsp;
</footer>
@endsection