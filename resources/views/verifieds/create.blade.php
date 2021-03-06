@extends('layouts.app')
@section('title', 'Create a Verified Post')

@section('content')
<div class="container" style="color: #B6B8D6">
    <h1>Create an Official Post</h1>
    {!! Form::open(['action' => 'VerifiedController@store', 'files' => true, 'method' => 'POST']) !!}
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
            {{ Form::label('title', 'Post Title')}}
            {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Post Title']) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description')}}
            {{ Form::textarea('description', '', ['class' => 'form-control', 'placeholder' => 'Post Description'])}}
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image')}}
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>

        {{ Form::submit('Submit', ['class' => 'btn btn-outline-primary', 'style' => 'margin-left: -15px;']) }}
    {!!Form::close() !!}

</div>
@endsection