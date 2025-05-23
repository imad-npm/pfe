@props(['name' => '', 'label' => '', 'value' => ''])

<label for="{{$name}}" class="block  text-sm font-medium mb-2">{{$label}}:</label>
<textarea type="text" name="{{$name}}" id="editor" 
       class="shadow appearance-none border rounded min-h-28 bg-gray-50
         w-full  leading-tight focus:outline-none focus:shadow-outline"
       placeholder="{{$name}}..." >{!! old($name, $value) !!}</textarea>


<script src="{{asset('js/ckeditor.js')}}"></script>


<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['bold', 'italic', 'link', 'bulletedList', 'numberedList', 'undo', 'redo'],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' }
                ]
            }
        })
        .then(editor => {
            editor.editing.view.change(writer => {
                writer.setStyle('height', '180px', editor.editing.view.document.getRoot());

              writer.setStyle('padding-left', '25px', editor.editing.view.document.getRoot());
                writer.setStyle('list-style-type', 'decimal', editor.editing.view.document.getRoot());
           
            });
        })
        .catch(error => console.error(error));
</script>



@error($name)
<div class="text-danger text-sm mt-1">{{ $message }}</div>
@enderror