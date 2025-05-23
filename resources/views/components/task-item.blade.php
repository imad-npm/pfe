<div class="p-2 shadow ">
<span class="text-blue-700">{{ $task->id }}</span> 
{{ $task->title }}
@if ($task->image )
   <img class="inline-block" width="100" src="{{asset("storage/".$task->image)}}" alt="" />
@endif
<div>
Created by <span class="text-primary">{{$task->user->name}}</span>
</div><a class="bg-primary rounded p-1 text-white" href="{{route("tasks.edit",$task->id )}}">Update</a>
</div>