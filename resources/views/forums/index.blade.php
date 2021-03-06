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
    <div class="row justify-content-center pb-3">
        <div class="col-md-8">
            <form action="/discussionsearch" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="qDiscussion"
                        placeholder="Search for a forum"><span class="input-group-btn" style="height:auto;
                        margin:auto;">
                        <button type="submit" class="btn btn-default" style="border: 1px solid rgb(182, 184, 214); background-color: rgb(182, 184, 214);">
                            <i class="fas fa-search text-white"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-5">
        @if(isset($details))
            <p class="text-white"> All users matching <b> '{{ $query }}' </b> are :</p>
            @foreach ($details as $qForum)
                <div class="row rounded my-2 mx-auto" style="border: 1px solid {{$qForum->category->color}};">
                    <div class="col-10">
                        <div class="row">
                            <div class="col-12">
                                <p class="text-white mt-2">
                                    <a href=" {{ route('forum.show', $qForum->slug) }} "><span style="color: white;">{{$qForum->title}}</span></a>
                                    @if ($qForum->pinned == 1)
                                        <span>
                                            <i class="fas fa-thumbtack" style="color: red;"></i>
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-12">
                                <p style="color: lightgrey;font-style:italic;">
                                    By {{ $qForum->user->username }}
                                    <span>
                                        @if (Gate::forUser($qForum->user)->allows('official-publisher', $qForum->user))
                                            <i class="fas fa-user-check"></i>
                                        @endif   
                                    </span>
                                    - {{ $qForum->time_ago($qForum->created_at) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-2 text-white text-center mt-2">
                        <i class="far fa-comment"></i> {{$qForum->replies->count()}}
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    @if(!(isset($details)))
        <div class="row">
            <div class="col-12 col-md-12 col-lg-3 col-xl-3">
                <ul class="nav nav-pills flex-column m-0 p-0">
                        <a href="{{ route('forum.create') }}"><button class="btn btn-primary my-2" id="new_discussion_btn"><i class="fas fa-plus-circle"></i> New Discussion</button></a>
                        <li class="my-2"><a href="{{ route('forum.index') }}"><i class="far fa-comment"></i>All Discussions</a></li>
                    @foreach ($categories as $cat)
                        <li>
                            <a href="{{ route('forum.index', ['category' => $cat->slug]) }}"><div class="chatter-box" style="background-color: {{$cat->color}}"></div>{{$cat->name}}</a>
                        </li>   
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-12 col-lg-9 col-xl-9 mx-auto">
                <h1 class="text-white" style="font-weight:bold;color:white;text-shadow:1px 1px 1px black;">{{$categoryName}}</h1>
                @if(isset($pinned))
                    @foreach ($pinned as $pin)
                        <div class="row rounded my-2 mx-auto" style="border: 1px solid {{$pin->category->color}}; border-left: 3px solid red;">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-white mt-2">
                                            <a href=" {{ route('forum.show', $pin->slug) }} "><span style="color: white;">{{$pin->title}}</span></a>
                                            <span>
                                                <i class="fas fa-thumbtack" style="color: red;"></i>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p style="color: lightgrey;font-style:italic;">
                                            By {{ $pin->user->username }}
                                            <span>
                                                @if (Gate::forUser($pin->user)->allows('official-publisher', $pin->user))
                                                    <i class="fas fa-user-check"></i>
                                                @endif   
                                            </span>
                                            - {{ $pin->time_ago($pin->created_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-white text-center mt-2">
                                <i class="far fa-comment"></i> {{$pin->replies->count()}}
                            </div>
                        </div>
                    @endforeach
                @endif
                <hr style="background-color: white;">
                @foreach ($discussions as $item)
                    @if ($item->pinned == '0')
                        <div class="row rounded my-2 mx-auto" style="border: 1px solid {{$item->category->color}}">
                            <div class="col-10">
                                <div class="row">
                                    <div class="col-12">
                                        <p class="text-white mt-2">
                                            <a href=" {{ route('forum.show', $item->slug) }} "><span style="color: white;">{{$item->title}}</span></a>
                                            <span class="rounded m-1" style="background-color: {{ $item->category->color }};font-weight:bold;color:white;text-shadow:1px 1px 1px black;">
                                                <span class="p-2">
                                                    {{$item->category->name}}
                                                </span>
                                            </span>
                                        </p>
                                    </div>
                                    <div class="col-12">
                                        <p style="color: lightgrey;font-style:italic;">
                                            By {{ $item->user->username }}
                                            <span>
                                                @if(Gate::forUser($item->user)->allows('official-publisher', $item->user))
                                                    <i class="fas fa-user-check"></i>
                                                @endif   
                                            </span>
                                            - {{ $item->time_ago($item->created_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-white text-center mt-2">
                                <i class="far fa-comment"></i> {{$item->replies->count()}}
                            </div>
                        </div>
                    @endif
                @endforeach
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        {{ $discussions->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection