@extends('layouts.app')
@section('title', 'Forum Home')

<style>
    .nav-pills > li > a {
        padding: 5px;
        padding-left: 30px;
        padding-right: 0px;
        position: relative;
    }
    .chatter-box {
        width: 10px;
        height: 10px;
        border-radius: 2px;
        float: left;
        position: absolute;
        top: 50%;
        margin-top: -5px;
        left: 10px;
    }
</style>

@section('content')
    <h1 class="text-white text-center">DashHound Forums</h1>
    <h4 class="text-center text-white">Start a new conversation</h4>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-3 col-xl-3">
            <ul class="nav nav-pills flex-column m-0 p-0">
                    <button class="btn btn-primary my-2" id="new_discussion_btn"><i class="fas fa-plus-circle"></i> New Discussion</button>
                    <li class="my-2"><a href="/forums"><i class="far fa-comment"></i>All Discussions</a></li>
                @foreach ($categories as $cat)
                    <li>
                        <a href="{{ route('forum.index', ['category' => $cat->slug]) }}"><div class="chatter-box" style="background-color: {{$cat->color}}"></div>{{$cat->name}}</a>
                    </li>   
                @endforeach<i class="far fa-comment"></i>
            </ul>
        </div>
        <div class="col-12 col-md-12 col-lg-9 col-xl-9">
            <h1 class="text-white" style="font-weight:bold;color:white;text-shadow:1px 1px 1px black;">{{$categoryName}}</h1>
            @foreach ($discussions as $item)
                <div class="row rounded my-2" style="border: 1px solid {{$item->category->color}}">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-white">
                                    {{$item->title}}
                                    <span class="rounded m-1" style="background-color: {{ $item->category->color }};font-weight:bold;color:white;text-shadow:1px 1px 1px black;">
                                        <span class="p-2">
                                            {{$item->category->name}}
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-12">
                                <p style="color: lightgrey;font-style:italic;">
                                    By {{ $item->user->name }} - {{ $item->time_ago($item->created_at) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 text-white text-center">
                        <i class="far fa-comment"></i> 10
                    </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $discussions->appends(request()->input())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection