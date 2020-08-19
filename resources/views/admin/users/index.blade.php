@extends('layouts.app')
@section('title', 'User Management')

@section('content')
<div class="container">
    @if(Auth::user()->hasRole('owner'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">User Management</div>

                    <div class="card-body text-dark">

                    <div class="row justify-content-center pb-3">
                        <div class="col-md-8">
                            <form action="/usersearch" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="qUser"
                                        placeholder="Search users"><span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container mt-5">
                        @if(isset($details))
                            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                        <table class="table table-striped">
                            <thead>
                            <tr style="border-bottom: 3px solid #B6B8D6;">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $qUser)
                                <tr style="border-bottom: 2px solid #B6B8D6;">
                                    <th scope="row">{{$qUser->id}}</th>
                                    <td>{{$qUser->name}}</td>
                                    <td>{{$qUser->email}}</td>
                                    <td>{{ implode(', ', $qUser->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $qUser->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $qUser) }}" method="POST" class="float-left">
                                                @csrf 
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">&times;</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                    </div>

                    <table class="table" style="border: 1px solid #B6B8D6;box-shadow:5px 10px #B6B8D6;">
                        <thead>
                            <tr style="border-bottom: 3px solid #B6B8D6;">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr style="border-bottom: 2px solid #B6B8D6;">
                                <th scope="row">{{$user->id}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    @can('edit-users')
                                        <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                    @endcan
                                    @can('delete-users')
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                            @csrf 
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-danger">&times;</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $users->links() }}
                    </div>

                        
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('administrator'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">User Management</div>

                    <div class="card-body text-dark">

                    <div class="row justify-content-center pb-3">
                        <div class="col-md-8">
                            <form action="/usersearch" method="POST" role="search">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="qUser"
                                        placeholder="Search users"><span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="container mt-5">
                        @if(isset($details))
                            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                        <table class="table table-striped">
                            <thead>
                            <tr style="border-bottom: 3px solid #B6B8D6;">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($details as $qUser)
                                @if(!($qUser->hasRole('owner') || $qUser->hasRole('administrator')))
                                <tr style="border-bottom: 2px solid #B6B8D6;">
                                    <th scope="row">{{$qUser->id}}</th>
                                    <td>{{$qUser->name}}</td>
                                    <td>{{$qUser->email}}</td>
                                    <td>{{ implode(', ', $qUser->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $qUser->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $qUser) }}" method="POST" class="float-left">
                                                @csrf 
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">&times;</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @endif
                        </div>


                        <table class="table" style="border: 1px solid #B6B8D6;box-shadow:5px 10px #B6B8D6;">
                            <thead>
                                <tr style="border-bottom: 3px solid #B6B8D6;">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            @if(!($user->hasRole('owner') || $user->hasRole('administrator')))
                                <tr style="border-bottom: 2px solid #B6B8D6;">
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                                @csrf 
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">&times;</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @elseif(Auth::user()->hasRole('moderator'))
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-secondary">User Management</div>

                    <div class="card-body text-dark">

                        <div class="row justify-content-center pb-3">
                            <div class="col-md-8">
                                <form action="/usersearch" method="POST" role="search">
                                    {{ csrf_field() }}
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="qUser"
                                            placeholder="Search users"><span class="input-group-btn">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="container mt-5">
                            @if(isset($details))
                                <p> The Search results for your query <b> {{ $query }} </b> are :</p>
                            <table class="table table-striped">
                                <thead>
                                <tr style="border-bottom: 3px solid #B6B8D6;">
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Roles</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($details as $qUser)
                                    @if(!($qUser->hasRole('owner') || $qUser->hasRole('administrator') || $qUser->hasRole('moderator')))
                                    <tr style="border-bottom: 2px solid #B6B8D6;">
                                        <th scope="row">{{$qUser->id}}</th>
                                        <td>{{$qUser->name}}</td>
                                        <td>{{$qUser->email}}</td>
                                        <td>{{ implode(', ', $qUser->roles()->get()->pluck('name')->toArray()) }}</td>
                                        <td>
                                            @can('edit-users')
                                                <a href="{{ route('admin.users.edit', $qUser->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                            @endcan
                                            @can('delete-users')
                                                <form action="{{ route('admin.users.destroy', $qUser) }}" method="POST" class="float-left">
                                                    @csrf 
                                                    {{ method_field('DELETE') }}
                                                    <button type="submit" class="btn btn-danger">&times;</button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>


                        <table class="table" style="border: 1px solid #B6B8D6;box-shadow:5px 10px #B6B8D6;">
                            <thead>
                                <tr style="border-bottom: 3px solid #B6B8D6;">
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                            @if(!($user->hasRole('owner') || $user->hasRole('administrator') || $user->hasRole('moderator')))
                                <tr style="border-bottom: 2px solid #B6B8D6;">
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                        @can('edit-users')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>   
                                        @endcan
                                        @can('delete-users')
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="float-left">
                                                @csrf 
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-danger">&times;</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection