@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
<div class="container text-white">
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->title ], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('title', 'Post Title')}}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Post Title' ]) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description')}}
            {{ Form::textarea('description', $post->description, ['class' => 'form-control', 'placeholder' => 'Post Description' ])}}
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image')}}
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        <div class="form-group row">
            {{ Form::label('spoilers', 'Spoilers?')}}
            {{ Form::select('spoilers', array('true' => 'Yes', 'false' => 'No'), null, ['class' => 'form-control', 'placeholder' => 'Does this post contain spoilers'])}}
        </div>
        {{ Form::hidden('_method', 'PATCH')}}
        {{ Form::submit('Submit', ['class' => 'btn btn-outline-primary', 'style' => 'margin-left: -15px;']) }}
    {!! Form::close() !!}
</div>
@endsection
