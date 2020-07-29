@extends('layouts.app')
@section('title', 'Edit Post')

@section('content')
<div class="container text-white">
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id ], 'files' => true, 'method' => 'POST']) !!}
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
        {{ Form::hidden('_method', 'PATCH')}}
        {{ Form::submit('Save Post', ['class' => 'btn btn-primary ml-0']) }}
    {!! Form::close() !!}
</div>
@endsection
