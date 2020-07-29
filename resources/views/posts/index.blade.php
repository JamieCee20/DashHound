@extends('layouts.app')
@section('title', 'View Posts')

@section('content')
<div class="container">
    @if($posts->count() == 0)
        <h2>Be the first to post a screenshot</h2>
    @endif
    @foreach($posts as $post)
        <div class="row my-3  p-2 bg-light" id="postBox">
            <div class="col-8">
                <p class="h2"><a href="/p/{{ $post->id }}">{{ $post->title }}</a></p>
            </div>
            <div class="col-4">
                <p class="text-muted font-italic ml-5 float-right">Author - {{ $post->user->name }}</p>
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