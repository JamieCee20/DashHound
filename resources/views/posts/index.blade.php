@extends('layouts.app')
@section('title', 'View Posts')

@section('content')
<div class="container mb-4">
    @if($posts->count() == 0)
        <h2>Be the first to post a screenshot</h2>
    @endif
    <div class="container bg-light">
        <h4 class="text-center pb-3">Top 3 Most Views Posts</h4>
        @foreach($popular_posts as $popular)
            <div class="row shadow-sm mb-5" style="height:60%;" id="postBox">
                <div class="col-1 py-2">
                    <img class="rounded-circle" src="/storage/profile/{{$popular->user->image}}" alt="profile image" height="90%;" width="100%;">
                </div>
                <div class="col-7">
                    <p class="ml-2" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $popular->id }}">{{ $popular->title }}</a></p>
                    <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $popular->user->name }} &middot; {{ date('MdS, Y' ,strtotime($popular->created_at)) }}</p>
                </div>
                <div class="col-2">
                    <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$popular->comments()->count()}}</p>
                    @if($popular->views == 0)
                        <p class="justify-content-center">Views: 0</p>
                    @else
                        <p class="justify-content-center"><span class="text-muted">Views:</span> {{ $popular->views }}</p>
                    @endif
                </div>
                <div class="col-2">
                    @if($popular->comments->isEmpty())
                        <p class="float-right font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
                    @else
                        <p class="float-right font-italic" style="opacity:0.6;font-size:14px;">{{ date('MdS, g:iA' ,strtotime($popular->comments->first()->created_at)) }} | {{ $popular->comments->first()->name }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <div class="container">
        <h4 class="text-center pb-3">All Posts</h4>
    </div>
    @foreach($posts as $post)
        <div class="container rowStripe">
            <div class="row shadow-sm" style="height:60%;" id="postBox">
                <div class="col-1 py-2">
                    <img class="rounded-circle" src="/storage/profile/{{$post->user->image}}" alt="profile image" height="90%;" width="100%;">
                </div>
                <div class="col-7">
                    <p class="ml-2" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->id }}">{{ $post->title }}</a></p>
                    <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->name }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
                </div>
                <div class="col-2">
                    <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$post->comments()->count()}}</p>
                    @if($post->views == 0)
                        <p class="justify-content-center">Views: 0</p>
                    @else
                        <p class="justify-content-center"><span class="text-muted">Views:</span> {{ $post->views }}</p>
                    @endif
                </div>
                <div class="col-2">
                    @if($post->comments->isEmpty())
                        <p class="float-right font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
                    @else
                        <p class="float-right font-italic" style="opacity:0.6;font-size:14px;">{{ date('MdS, g:iA' ,strtotime($post->comments->first()->created_at)) }} | {{ $post->comments->first()->name }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    </div>

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection