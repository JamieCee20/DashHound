@extends('layouts.app')
@section('title', 'View Posts')

@section('extra-css')
    <link href="{{ asset('css/index-style.css') }}" rel="stylesheet">
@endsection

@section('extra-js')

@endsection

@section('content')
<div class="container mb-4">
    @if($posts->count() == 0)
        <h2>Be the first to post a screenshot</h2>
    @endif
    <div class="p-3">
        <h4 class="text-center py-3 popular-header">Top 3 Most Views Posts</h4>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-light float-right" href="{{ route('post.create') }}">Create Post</a>
            </div>
        </div>
        @foreach($popular_posts as $popular)
            <div class="row shadow-sm mb-5 page-display" style="height:60%;" id="postBox">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 pr-4 mx-auto">
                    <div class="img">
                        <img src="/storage/posts/{{$popular->image}}" alt="profile image" class="rounded post-index-image" height="90%;" width="100%;">
                        <div class="overlay-color centered">
                            @if($popular->views == 0)
                                <p class="justify-content-center">Views: 0</p>
                            @else
                                <p class="justify-content-center"><span class="text-image">Views:</span> {{ $popular->views }}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 border-left post-links">
                    @if($popular->spoilers == 1)
                            <h2 class="overflow-wrap" style="min-width:100%;letter-spacing:2px;"><a href="/p/{{ $popular->title }}">{{ $popular->title }}</a></h2>
                            <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $popular->user->username }} &middot; {{ date('MdS, Y' ,strtotime($popular->created_at)) }}</p>
                            <p class="text-center py-3 text-white" style="margin:auto;width:100%;">
                                &diams; This post may contain <strong>Spoilers</strong> &diams;
                            </p>
                    @elseif($popular->spoilers == 0)
                            <h2 class="overflow-wrap" style="min-width:100%;letter-spacing:2px;"><a href="/p/{{ $popular->title }}">{{ $popular->title }}</a></h2>
                            <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $popular->user->username }} &middot; {{ date('MdS, Y' ,strtotime($popular->created_at)) }}</p>
                    @endif
                    @if(strlen($popular->description) > 200)
                        <p class="text-white comment more">
                            {{substr($popular->description, 0, 200)}}...
                        </p>
                        <a role="button" class="btn btn-outline-light" href="{{ route("post.show", $popular->title) }}">Read More</a>
                    @else
                    <p class="text-white">
                        {{$popular->description}}
                    </p>
                    @endif
                </div>
                <div class="d-none d-sm-none d-md-block col-md-2 text-white my-auto">
                    <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$popular->comments()->count()}}</p>
                    <div class="my-3">
                        @if($popular->comments->isEmpty())
                            <p class="font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
                        @else
                            <p class="font-italic" style="opacity:0.6;font-size:14px;">{{ date('M dS, g:iA' ,strtotime($popular->comments->first()->created_at)) }} | {{ $popular->comments->first()->name }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <hr class="splitter">
    <div class="container">
        <h4 class="text-center pb-3 popular-header">All Posts</h4>
    </div>
    @foreach($posts as $post)
        <div class="post-rows text-white">
            <div class="row shadow-sm" style="height:60%;" id="postBox">
                <div class=" d-none d-sm-none d-md-block col-md-2 col-lg-1 col-xl-1 py-2">
                    <img class="rounded-circle" src="/storage/posts/{{$post->image}}" alt="profile image" height="90%;" width="100%;">
                </div>
                @if($post->spoilers == 1)
                    <div class="col-8 col-sm-8 col-md-5 col-lg-5 col-xl-5">
                        <p class="ml-2 overflow-wrap" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->title }}">{{ $post->title }}</a></p>
                        <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->username }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
                    </div>
                    <div class="col-2">
                        <p class="text-center py-3" style="margin:auto;width:100%;">
                            This post may contain <strong style="color:#B6B8D6;">Spoilers</strong>
                        </p>
                    </div>
                @elseif($post->spoilers == 0)
                    <div class="col-7">
                        <p class="ml-2 overflow-wrap" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->title }}">{{ $post->title }}</a></p>
                        <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->username }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
                    </div>
                @endif
                <div class="d-none d-sm-none d-md-block col-md-2 col-lg-2 col-xl-2">
                    <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$post->comments()->count()}}</p>
                    @if($post->views == 0)
                        <p class="justify-content-center">Views: 0</p>
                    @else
                        <p class="justify-content-center"><span class="text-muted">Views:</span> {{ $post->views }}</p>
                    @endif
                </div>
                <div class="d-none d-sm-none d-md-block col-md-2 col-lg-2 col-xl-2">
                    @if($post->comments->isEmpty())
                        <p class="font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
                    @else
                        <p class="font-italic" style="opacity:0.6;font-size:14px;">{{ date('MdS, g:iA' ,strtotime($post->comments->first()->created_at)) }} | {{ $post->comments->first()->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <div class="row my-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links('vendor.pagination.simple-default') }}
        </div>
    </div>
</div>
@endsection
