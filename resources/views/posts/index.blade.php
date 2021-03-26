@extends('layouts.app')
@section('title', 'View Posts')

@section('extra-css')
    <link href="{{ asset('css/index-style.css') }}" rel="stylesheet">
@endsection

@section('extra-js')

@endsection

@section('content')
<div class="container mb-4">

    {{-- Section relates to the create post button and top 3 most viewed posts --}}
    <div class="p-3">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-light float-right" href="{{ route('post.create') }}">Create Post</a>
            </div>
        </div>
        <h4 class="text-center py-3 popular-header">Top 3 Most Views Posts</h4>
        {{-- Each statement will display loop of posts unless empty, will display no post view --}}
        @each('posts.popular-posts', $popular_posts, 'popular', 'posts.no-posts')
    </div>

    <hr class="splitter">

    {{-- Section relating to all posts being displayed --}}
    <div class="container">
        <h4 class="text-center pb-3 popular-header">All Posts</h4>
    </div>
        {{-- Each statement will display loop of posts unless empty, will display no post view --}}
        @each('posts.posts', $posts, 'post', 'posts.no-posts')
    </div>

    {{-- Simple pagination when posts hits display limit per page --}}
    <div class="row my-5">
        <div class="col-12 d-flex justify-content-center">
            {{ $posts->links('vendor.pagination.simple-default') }}
        </div>
    </div>
</div>
@endsection
