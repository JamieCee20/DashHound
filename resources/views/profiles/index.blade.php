@extends('layouts.app')
@section('title', 'Edit Profile')

@section('extra-css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row bg-light p-2">
        <div class="col-3 my-auto d-flex">
            <i class="far fa-user fa-2x"></i>
            <div class="justify-content-center d-flex text-center my-auto">
                <h5 class="mr-2">User: </h5><p> {{$user->username}}</p>
            </div>
        </div>
        <div class="col-2 offset-7 my-auto text-right">
            @if(auth()->user() == $user)
                <a role="button" class="btn btn-primary" href="/profile/{{$user->id}}/edit">Edit Profile</a>
            @endif
        </div>
    </div>
    <div class="row rounded bg-light pl-3 pr-3 pt-3" id="profile-border">
        <div class="col-12">
            <div class="row">
                <div class="col-4 bg-light px-1">
                    <div class="p-3 rounded h-100">
                        <img src="/storage/profile/{{$user->image}}" height="100%" width="75%" class="border border-dark rounded-circle">
                    </div>
                </div>
                <div class="col-6 offset-2 bg-light pt-3">
                    <h4>{{ $user->name }}</h4><br>
                    {{-- <p>{{ $user->roles()->first()->name }}</p> --}}
                    <p class="text-faded">
                        Role: 
                        @foreach($user->roles as $role)
                            <span style="font-style: italic;">{{ $role->name }}</span>
                            
                            @if(!$loop->last)
                            ,
                            @endif
                        @endforeach
                    </p>
                    <h5 style="text-decoration: underline">About Me</h5>
                    @if(isset($user->bio))
                    <p>
                        {{$user->bio}}
                    </p>
                    @elseif(Auth::user()->id == $user->id) 
                        <p>Edit profile to add a bio</p>
                    @endif
                </div>
            </div>
            <div class="row bg-light">
                <div class="col-12" style="border-bottom: 1px solid grey;">
                    <h5>Account</h5>
                </div>
            </div>
            <div class="row d-flex bg-light mt-2">
                <div class="col-6">
                    <h5 style="font-weight: bold;">Your Name: </h5>
                </div>
                <div class="col-6">
                    <p>{{ $user->name }}</p>
                </div>
            </div>
            <div class="row d-flex bg-light mt-2">
                <div class="col-6">
                    <h5 style="font-weight: bold;">Your Email: </h5>
                </div>
                <div class="col-6">
                    <p>{{ $user->email }}</p>
                </div>
            </div>
            <div class="row d-flex bg-light mt-2">
                <div class="col-6">
                    <h5 style="font-weight: bold;">Your Username: </h5>
                </div>
                <div class="col-6">
                    <p>{{ $user->username }}</p>
                </div>
            </div>
            <div class="row d-flex bg-light mt-2">
                <div class="col-6">
                    <h5 style="font-weight: bold;">Your Total Posts: </h5>
                </div>
                <div class="col-6">
                    <p>{{ $user->posts()->count() }}</p>
                </div>
            </div>
            @if($user->can('post-verified-create'))
                <div class="row d-flex bg-light mt-2">
                    <div class="col-6">
                        <h5 style="font-weight: bold;">Your Total  Published Posts: </h5>
                    </div>
                    <div class="col-6">
                        <p>{{ $user->vposts()->count() }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
    @if(count($posts) > 0)
        <div class="row mt-3">
            @foreach($posts as $post)
                <div class="col-4">
                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{$post->title}}</div>
                        <img src="/storage/posts/{{$post->image}}" alt="Post Image" height="100%" width="100%">
                        <div class="card-body">
                            <h5 class="card-title text-center"><a href="{{route('post.show', $post->title)}}" class="btn btn-outline-secondary">View Post</a></h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-4 d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
    @endif

    @if(count($vposts) > 0)
        <div class="row mt-3 mb-3">
            @foreach($vposts as $vpost)
                <div class="col-4">
                    <div class="card bg-light mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{$vpost->title}}</div>
                        <img src="/storage/posts/{{$vpost->image}}" alt="Post Image" height="100%" width="100%">
                        <div class="card-body">
                            <h5 class="card-title text-center"><a href="{{route('post.show', $vpost->title)}}" class="btn btn-outline-secondary">View Post</a></h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-4 d-flex justify-content-center">
                {{ $vposts->links() }}
            </div>
        </div>
    @endif
@endsection