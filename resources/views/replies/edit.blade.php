@extends('layouts.app')
@section('title', 'Edit Forum Post')

@section('content')
<div class="container text-white">
    <h1>Edit Reply</h1>
    {!! Form::open(['action' => ['ReplyController@update', $reply->id], 'files' => true, 'method' => 'POST']) !!}
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
        <div class="row">
            <div class="col-md-12">
                {!!Form::textarea('body', $reply->body, ['class' => 'form-control', 'id' => 'replyBody', 'placeholder' => 'What is on your mind?...'])!!}
                {{ Form::hidden('_method', 'PATCH')}}
                {{Form::submit('Update', ['class' => 'btn btn-dark btn-block', 'style' => 'color: white;font-weight: bold;'])}}
            </div>
        </div>
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
