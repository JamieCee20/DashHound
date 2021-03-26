@extends('layouts.app')
@section('title', 'Create a Post')

@section('content')
<div style="color: #B6B8D6;margin:auto;">
    <h1 class="text-center">Create a new Post<br>
        <span class="font-italic text-center" style="color: #c2c4c2;font-size:14px;">Fields marked * are required</span>
    </h1>
    {!! Form::open(['action' => 'PostsController@store', 'files' => true, 'method' => 'POST', 'style' => 'margin: auto;width:90%;']) !!}
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
            {{ Form::label('title', 'Post Title*')}}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Post Title']) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description*')}}
            {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Post Description'])}}
        </div>
        <div class="form-group row">
            <div class="row">
                <div class="col-12">
                    {{ Form::label('spoilers', 'Mark this with spoilers?')}}
                </div>
                <div class="col-12">
                    {{ Form::label('#true-statement', 'Yes')}}
                    {{ Form::radio('spoilers', 'true', false, ['id' => 'true-statement'])}}
                </div>
                <div class="col-12">
                    {{ Form::label('#false-statement', 'No')}}
                    {{ Form::radio('spoilers', 'false', true, ['id' => 'false-statement'])}}
                </div>
            </div>
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image*')}}
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        {{ Form::submit('Submit', ['class' => 'btn btn-outline-success', 'style' => 'margin-left: -15px;']) }}
    {!!Form::close() !!}
</div>
@endsection