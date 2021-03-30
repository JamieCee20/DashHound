@extends('layouts.app')
@section('title', 'User Management')

@section('content')
<div class="container">
    @if(Auth::user()->hasRole('owner'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">Edit User - {{ $user->username }}</div>

                    <div class="card-body text-dark">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ $user->username }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            @csrf 
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>

                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                            <div class="form-check">
                                                <input id="roles" type="checkbox" name="roles[]" value="{{ $role->id }}" @if( $user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                <label for="roles">{{ $role->name }}</label>
                                            </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex">
                                    <button class="btn btn-primary" type="submit">Update User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('administrator'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">Edit User - {{ $user->username }}</div>

                    <div class="card-body text-dark">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ $user->username }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            @csrf 
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>

                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                        @if(!($role->name == "owner" || $role->name == "administrator"))
                                            <div class="form-check">
                                                <input id="roles" type="checkbox" name="roles[]" value="{{ $role->id }}" @if( $user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                <label for="roles">{{ $role->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('moderator'))
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">Edit User - {{ $user->username }}</div>

                    <div class="card-body text-dark">
                        <form action="{{ route('admin.users.update', $user) }}" method="POST">

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">Username</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('username') is-invalid @enderror" name="name" value="{{ $user->username }}" required autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            @csrf 
                            {{ method_field('PUT') }}
                            <div class="form-group row">
                                <label for="roles" class="col-md-2 col-form-label text-md-right">Roles</label>

                                <div class="col-md-6">
                                    @foreach($roles as $role)
                                        @if(!($role->name == "owner" || $role->name == "administrator" || $role->name == "moderator"))
                                        <div class="form-check">
                                                <input id="roles" type="checkbox" name="roles[]" value="{{ $role->id }}" @if( $user->roles->pluck('id')->contains($role->id)) checked @endif>
                                                <label for="roles">{{ $role->name }}</label>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection