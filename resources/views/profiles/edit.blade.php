@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
<div class="container text-white">
    {!! Form::open(['action' => ['ProfilesController@update', $user->id], 'files' => true, 'method' => 'POST']) !!}
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
            {{Form::label('name', 'Your Name')}}
            {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Enter your name'])}}
        </div>

        <div class="form-group row">
            {{Form::label('email', 'Your Email Address')}}
            {{Form::email('email', $user->email, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('username', 'Your Username')}}
            {{Form::text('username', $user->username, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('bio', 'Your Personal Description')}}
            {{Form::textarea('bio', $user->bio, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('image', 'Profile Image', ['class' => 'mr-4'])}}
            {{Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        {{Form::hidden('_method', 'PATCH')}}
        {{Form::submit('Update Profile', ['class' => 'btn btn-primary', 'style' => 'margin-left: -15px'])}}
    {!! Form::close() !!}
</div>
@endsection