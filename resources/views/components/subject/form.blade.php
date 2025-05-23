@props(['subject'=>null, "action"=>'' ,'options'=>null,"specialities"=>null])

  
<x-form :action="$action" 
 method="post" >
   
    @if(!empty($subject))
    @method('PUT')  
    @endif

    @csrf

    <x-legend>{{!empty($subject)? "Edit Subject":'Create a Subject' }}</x-legend>
    <div class="my-3">
        <x-input-text required label="title" name="title"
         :value="old('title',$subject->title ?? '')" />
</div> 

<div class="my-3">
    <x-text-area-rich required label="description" name="description" 
    :value="old('description',$subject->description ?? '')" />
</div> 

<div class="my-3">
    <x-input-text label="tags" placeholder="Example:ai,web-dev,machine_learning,data science...
" name="tags"
     :value="old('tags',$subject->tags ?? '')" />
</div> 

<div class="my-3">
    <x-datalist required label="supervisor"
     :selected_id="old('supervisor_id', $subject->supervisor_id ?? null )" name="supervisor_id" 
     :options="$options"  />
</div> 

<div class="my-3">
    <x-datalist label="co-supervisor" name="co_supervisor_id"
     :selected_id="old('co_supervisor_id', $subject->co_supervisor_id ?? null )"  :options="$options"   />
</div> 


<div class="flex gap-1">
  
<x-select class="block mt-1 w-full" label="speciality1" name="speciality1_id"
 :options="$specialities" :selectedValue="$subject?->speciality1_id?? '' "  required
  autofocus autocomplete="username" />
<x-select class="block mt-1 w-full" :selectedValue="$subject?->speciality2_id ?? '' "
     label="speciality2" name="speciality2_id"
 :options="$specialities"  />
<x-select class="block mt-1 w-full" :selectedValue="$subject?->speciality3_id ?? '' "
     label="speciality3" name="speciality3_id"
 :options="$specialities" />
</div>


  <x-button.submit  />
</x-form>


