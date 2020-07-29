@extends('layouts.app')
@section('title', 'Edit Profile')

@section('content')
<div class="container">
    <div class="row bg-white rounded d-flex" style="border: 2px solid #B6B8D6">
        <div class="col-lg-5">
            <div class="p-3 rounded h-100">
                <img src="/storage/profile/{{$user->image}}" height="100%" width="100%" class="border border-dark rounded h-100">
            </div>
        </div>
        <div class="col-lg-5 pt-5 offset-2" id="profileBody">
            <div class="rounded ml-2 px-2 pt-2">
                <div class="d-flex justify-content-between align-items-baseline">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4" style="border-bottom: 2px solid black;width:100%;">{{ $user->name}}</div>
                    </div>
                </div>
    
                @if(auth()->user() == $user)
                    <a href="/profile/{{$user->id}}/edit">Edit Profile</a>
                @endif
    
                <div class="pt-4" style="font-weight: bold">
                    <div class="row">
                        <div class="col col-6 d-flex">
                            <p class="text-justify" style="font-weight: bold;">Your Name: </p>
                            <p class="text-justify ml-4" style="font-weight:normal;">
                                {{ $user->name }}
                            </p>
                        </div>
                    </div>
                </div>
    
                <div class="pt-4" style="font-weight: bold">
                    <div class="row">
                        <div class="col col-6 d-flex">
                            <p class="text-justify" style="font-weight: bold;">Your Email: </p>
                            <p class="text-justify ml-4" style="font-weight:normal;">
                                {{ $user->email }}
                            </p>
                        </div>
                    </div>
                </div>
    
                <div class="pt-4" style="font-weight: bold">
                    <div class="row">
                        <div class="col col-6 d-flex">
                            <p class="text-justify" style="font-weight: bold;">Your Username: </p>
                            <p class="text-justify ml-4" style="font-weight:normal;">
                                {{ $user->username }}
                            </p>
                        </div>
                    </div>
                </div>          
                <div class="pt-4" style="font-weight: bold">
                    <div class="row">
                        <div class="col col-6 d-flex">
                            <p class="text-justify" style="font-weight: bold;">Your Total Posts: </p>
                            <p class="text-justify ml-4" style="font-weight:normal;">
                                {{ $user->posts()->count() }}
                            </p>
                        </div>
                    </div>
                </div>          
            </div>
        </div>
    </div>
</div>
<hr class="w-100" style="color:#B6B8D6;">
@if(isset($user->bio))
<div class="container">
    <div class="row">
        <div class="col col-12 text-underline">
            <h3 class="display-4 font-weight-normal text-center">Your Bio</h3>
        </div>
        <div class="col col-sm-12 col-md-12">
            {{$user->bio}}
        </div>
    </div>
</div>
@endif
@if( count($posts) > 0)
    <hr class="w-100" style="color:#B6B8D6;">
@endif
<div class="container">
    @if( count($posts) > 0)
        <div class="row">
            <div class="col col-sm-12 col-md-12 text-underline">
                <h3 class="display-4 font-weight-normal text-center">Your Posts</h3>
            </div>
        </div>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-lg-4 col-sm-12 col-md-4 mb-2" id="profilePosts">
                    <div class="card h-75" style="width: 18rem;border: 3px solid #B6B8D6;">
                        <a href="/p/{{$post->id}}"><img class="card-img-top" src="/storage/posts/{{$post->image}}" alt="Card image cap"></a>
                        <div class="card-body overflow-auto">
                            <h5 class="card-title"><u><b>{{$post->title}}</b></u></h5>
                            <p class="card-text">{{$post->description}}</p>
                        </div>
                        <div class="card-footer text-muted text-center mt-4">
                        {{ date('F nS, Y - g:iA' ,strtotime($post->created_at)) }}
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
</div>
@if( count($vposts) > 0)
    <hr class="w-100" style="color:#B6B8D6;">
@endif
<div class="container mb-5">
    @if( count($vposts) > 0)
        <div class="row">
            <div class="col col-sm-12 col-md-12 text-underline">
                <h3 class="display-4 font-weight-normal text-center">Official Posts</h3>
            </div>
        </div>
        <div class="row">
            @foreach($vposts as $vpost)
                <div class="col-lg-4 col-sm-12 col-md-4 mb-2" id="profilePosts">
                    <div class="card" style="width: 18rem;border: 3px solid #B6B8D6;">
                        <a href="/v/{{$vpost->id}}"><img class="card-img-top" src="/storage/posts/{{$vpost->image}}" alt="Card image cap"></a>
                        <div class="card-body overflow-auto" style="height:300px;">
                            <h5 class="card-title"><u><b>{{$vpost->title}}</b></u></h5>
                            <p class="card-text">{{$vpost->description}}</p>
                        </div>
                        <div class="card-footer text-muted text-center mt-4">
                        {{ date('F nS, Y - g:iA' ,strtotime($vpost->created_at)) }}
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
</div>
@endsection