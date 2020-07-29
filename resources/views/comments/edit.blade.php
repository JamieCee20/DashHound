@extends('layouts.app')
@section('title', 'Edit Comment')

@section('content')
<div class="container text-white">
    <h1>Edit Comment</h1>
    {!! Form::open(['action' => ['CommentsController@update', $comment->id ], 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('comment', 'Comment: ')}}
            {{ Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'placeholder' => 'Comment' ])}}
        </div>
        {{Form::hidden('_method', 'PATCH')}}
        {{ Form::submit('Save Comment', ['class' => 'btn btn-primary ml-0']) }}
    {!! Form::close() !!}
</div>
@endsection
