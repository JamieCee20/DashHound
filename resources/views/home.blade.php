@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Search users"><span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-secondary">Welcome, {{Auth::user()->name}}</div>

                <div class="card-body">
                    <p class="text-dark">Welcome to DashHound, the home of game sharing experiences!</p>
                    <img src="http://www.jlcwd.me/img/dashhound.jpg" width="100%" alt="DashHound Logo">
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        @if(isset($details))
            <p> The Search results for your query <b> {{ $query }} </b> are :</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $user)
                <tr>
                    <td><a href="/profile/{{$user->id}}" style="color: black; text-decoration:none;">{{$user->name}}</a></td>
                    <td>{{$user->email}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection

