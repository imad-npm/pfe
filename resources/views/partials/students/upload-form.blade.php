
<form action="{{route("students.upload")}}" method="POST" enctype="multipart/form-data" >
    @csrf 
        <label for="{{$speciality}}">{{$speciality}}</label>
        <input type="hidden" name="speciality" value="{{$speciality}}">
        <input id="{{$speciality}}" type="file" name='students_file' />
        <button type="submit">Upload</button> 

</form>
