
<form action="{{route("admin.students.upload")}}"
class="p-2 mb-8 h-2xl"
 method="POST" enctype="multipart/form-data" >
    @csrf 
        <label class="block font-semibold text-xl" for="{{$speciality}}">Upload {{$speciality}} students </label>
        <input type="hidden" name="speciality" value="{{$speciality}}">
        <input id="{{$speciality}}"class="border p-2 h-100 rounded" type="file" name='students_file' />
        <button class="rounded p-2 bg-slate-900 text-white" type="submit">Upload</button> 

</form>
