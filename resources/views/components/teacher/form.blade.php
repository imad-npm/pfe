
@props(['teacher'=>null, "action"=>'','teacherType'=>null])


@php
    use App\Constants\TeacherType ;
    
@endphp


<x-form action="{{$action}}"  method="post">

@if (isset($teacher))
    @method('Put')
@endif

        <x-legend>
            @if (!isset($teacher))
            {{$teacherType==TeacherType::INTERNAL ? "Create an Internal Teacher" :"Create an External Teacher"
            }}
                
            @else
                  {{$teacherType==TeacherType::INTERNAL ? "Edit  Internal Teacher" :"Edit  External Teacher"
            }}
  
            @endif
          
        </x-legend>

    <div class="my-3">
        <x-input-text required label="firstname" name="firstname" 
        :value="old('firstname',$teacher?->firstname ?? '')" />
</div> 

<div class="my-3">
    <x-input-text required label="lastname" name="lastname" 
    :value="old('lastname',$teacher?->lastname ?? '')" />
</div> 
<div class="my-3">
    <x-input-text required label="rank" name="rank"
    :value="old('rank',$teacher?->rank ?? '')" />
</div> 


@if ($teacherType==TeacherType::EXTERNAL /*|| $teacherType=="all"*/)
    <div class="my-3">
    <x-input-text required label="institution" name="institution"
     :value="old('institution',$teacher?->institution ?? '' )" />
</div> 

@endif

   <div class="my-3">
        <x-input-text required label="email" name="email"
        :value="old('email',$teacher?->email ?? '')" />
</div>

@if ($teacherType==TeacherType::INTERNAL /*|| $teacherType=="all"*/)
<div class="my-3 ">
    <x-input-password   
        :label="!isset($teacher) ? 'password' : 'password (Leave blank if not changing)'"
        :required="!isset($teacher)"
        name="password"  placeholder="password" />
</div>
<div class="my-3 ">
    <x-input-password
    :required="!isset($teacher)"

     label="confirm password" name="password_confirmation"  />
</div>
@endif



    <x-button.submit  />
</x-form>

