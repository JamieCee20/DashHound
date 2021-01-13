@extends('layouts.app')

@section('title', 'Create a ticket')

@section('content')
    <div class="row" style="color: white;">
        <div class="col-12">
            <h1>Create a Ticket</h1>
        </div>
        <div class="col-12 justify-content-center text-center">
            {!! Form::open(['action' => 'TicketController@store', 'files' => true, 'method' => 'POST']) !!}
            <div class="form-group row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="form-group row">
                {{ Form::label('title', 'Ticket Title')}}
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title your ticket']) }}
            </div>
            <div class="form-group row">
                {{ Form::label('body', 'Ticket Query')}}
                {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Type your query here...', 'id' => 'ticketBody'])}}
            </div>
            <div class="form-group row">
                <span class="text-white">{{ Form::label('category', 'Select your issue')}}</span>
                <span class="my-auto ml-2">{{ Form::select('category', $categories, ['class' => 'form-control'])}}</span>
            </div> 
            {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
        {!!Form::close() !!}
        </div>
    </div>
@endsection
@section('editor-js')
    <script src="https://cdn.tiny.cloud/1/ijfbgkzbhtffss6jx1a1jcgeuxzesckga022eg6os2bg3xjl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            force_p_newlines : false,
            force_br_newlines : true,
            convert_newlines_to_brs : false,
            remove_linebreaks : true,
            forced_root_block : '',  
            selector: 'textarea#ticketBody',
            plugins: 'image',
            width: "100%",
            menubar: 'file edit view format insert',
            toolbar: 'undo redo | bold | align | image',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            /* enable title field in the Image dialog*/
            image_title: true,
            image_file_types: 'jpg,jpeg,svg,png',
            image_upload_url: '/tickets',
            /* enable automatic uploads of images represented by blob or data URIs*/
            automatic_uploads: true,
            /*
                URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                images_upload_url: 'postAcceptor.php',
                here we add custom filepicker only to Image dialog
            */
            file_picker_types: 'image',
            /* and here's our custom image picker*/
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
    
                /*
                Note: In modern browsers input[type="file"] is functional without
                even adding it to the DOM, but that might not be the case in some older
                or quirky browsers like IE, so you might want to add it to the DOM
                just in case, and visually hide it. And do not forget do remove it
                once you do not need it anymore.
                */
    
                input.onchange = function () {
                var file = this.files[0];
    
                var reader = new FileReader();
                reader.onload = function () {
                    /*
                    Note: Now we need to register the blob in TinyMCEs image blob
                    registry. In the next release this part hopefully won't be
                    necessary, as we are looking to handle it internally.
                    */
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
    
                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
                };
    
                input.click();
            },
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
        });
    </script>
@endsection