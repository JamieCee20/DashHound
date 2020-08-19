@extends('layouts.app')
@section('title', 'View Posts')

@section('content')
<div class="container">
    @if($posts->count() == 0)
        <h2>Be the first to post a screenshot</h2>
    @endif
    @foreach($posts as $post)
        <div class="container rowStripe">
            <div class="row shadow-sm" style="height:60%;" id="postBox">
                <div class="col-1 py-2">
                    <img class="rounded-circle" src="/storage/profile/{{$post->user->image}}" alt="profile image" height="75%;" width="100%;">
                </div>
                <div class="col-7">
                    <p class="ml-2" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->id }}">{{ $post->title }}</a></p>
                    <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->name }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
                </div>
                <div class="col-2">
                    <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$post->comments()->count()}}</p>
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

    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection