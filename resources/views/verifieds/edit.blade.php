@extends('layouts.app')
@section('title', 'Edit Published Post')

@section('content')
<div class="container text-white">
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['VerifiedController@update', $verified->id ], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('title', 'Post Title')}}
            {{ Form::text('title', $verified->title, ['class' => 'form-control', 'placeholder' => 'Post Title' ]) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description')}}
            {{ Form::textarea('description', $verified->description, ['class' => 'form-control', 'placeholder' => 'Post Description' ])}}
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image')}}
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        {{ Form::hidden('_method', 'PATCH')}}
        {{ Form::submit('Submit', ['class' => 'btn btn-outline-primary', 'style' => 'margin-left: -15px;']) }}
    {!! Form::close() !!}
</div>
@endsection
