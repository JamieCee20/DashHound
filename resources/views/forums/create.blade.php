@extends('layouts.app')
@section('title', 'Create new Discussion')

@section('content')
    <div class="row">
        <div class="col-12">
            <h1 class="text-white">Create new Discussion</h1>
        </div>
        <div class="col-12 justify-content-center text-center">
            {!! Form::open(['action' => 'DiscussionController@store', 'files' => true, 'method' => 'POST']) !!}
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
                {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Discussion Title']) }}
            </div>
            <div class="form-group row">
                {{ Form::label('body', 'Discussion Content')}}
                {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Discussion Content', 'id' => 'discussionBody'])}}
            </div>
            <div class="form-group row">
                <span class="text-white">{{ Form::label('category', 'Category')}}</span>
                <span class="my-auto ml-2">{{ Form::select('category', $categories, ['class' => 'form-control'])}}</span>
            </div>
            @can('pinned-post', Auth::user())
                <div class="form-group row">
                    <span class="text-white">{{ Form::label('pinned', 'Do you wish to pin this post')}}</span>
                    <span class="my-auto ml-2">{{ Form::checkbox('pinned', 'true')}}</span>
                </div>
            @endcan   
            {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
        {!!Form::close() !!}
        </div>
    </div>

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
@endsection
