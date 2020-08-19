@extends('layouts.app')
@section('title', 'Verified Publishers')

@section('content')
    <div class="container">
        @if($vposts->count() == 0)
            <h2>Be the first to post a screenshot</h2>
        @endif
    </div>
    <div class="container">
        @foreach($vposts as $vpost)
            <div class="row my-3  p-2 bg-light" id="postBox">
                <div class="col-6">
                    <img class="mx-auto" src="/storage/posts/{{$vpost->image}}" height="200px" width="75%" alt="Published Image">
                </div>
                <div class="col-6 text-left">
                    <p class="h2"><a href="/v/{{ $vpost->id }}">{{ $vpost->title }}</a></p><br>
                    <p class="text-muted font-italic">Published by: {{ $vpost->user->name }} | {{ date('F dS, Y - g:iA' ,strtotime($vpost->created_at)) }}</p><br><br>
                    <p class="text-muted font-italic">
                        <strong>Total Likes: </strong>{{ $vpost->likes()->count() }}
                    </p>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $vposts->links() }}
            </div>
        </div>
    </div>
@endsection