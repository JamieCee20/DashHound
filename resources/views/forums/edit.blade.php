@extends('layouts.app')
@section('title', 'Edit Forum Post')

@section('content')
<div class="container text-white">
    <h1>Edit Discussion</h1>
    {!! Form::open(['action' => ['DiscussionController@update', $discussion->slug], 'files' => true, 'method' => 'POST']) !!}
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
            {{ Form::label('title', 'Discussion Title')}}
            {{ Form::text('title', $discussion->title, ['class' => 'form-control', 'placeholder' => 'Discussion Title']) }}
        </div>
        <div class="form-group row">
            {{ Form::label('body', 'Discussion Content')}}
            {{ Form::textarea('body', $discussion->body, ['class' => 'form-control', 'placeholder' => 'Discussion Content', 'id' => 'discussionBody'])}}
        </div>  
        {{ Form::hidden('_method', 'PATCH')}}
        {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
    {!!Form::close() !!}
</div>
@endsection

@section('editor-js')
    <script src="https://cdn.tiny.cloud/1/ijfbgkzbhtffss6jx1a1jcgeuxzesckga022eg6os2bg3xjl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#discussionBody',
            width: "100%",
            menubar: 'file edit view format',
            plugins: 'casechange linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
            toolbar: 'undo redo | bold | align | casechange checklist pageembed table media tinymcespellchecker',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
        });
        </script>
@endsection
