@extends('layouts.app')
@section('title', 'Forum Post')


@section('content')
    <div class="row mb-5">
        <div class="col-12">
            <div class="h3 rounded" style="color: white">{{$discussion->title}}</div>
        </div>
        <div class="col-12 d-flex" style="color: white;">
            <p>
                <i class="fas fa-user"></i> {{$discussion->user->name}} 	&middot; <i class="fas fa-clock"></i> {{ date('M dS, g:iA' ,strtotime($discussion->created_at)) }} 	&middot; <i class="fas fa-reply"></i> {{$replies->count()}}
            </p>
        </div>
        <div class="col-12">
            <a href="{{ url('/forums?category='.$discussion->category->name.'') }}" role="button" class="btn btn-outline-light"><i class="fas fa-chevron-left"></i> {{$discussion->category->name}}</a>
        </div>
    </div>
    <div class="row ml-0 mr-0" style="background-color: lightgrey;">
        <div class="col-12 col-md-12 col-lg-2 col-xl-2 text-center mx-auto p-1">
            <div class="p-2">
                <img src="/storage/profile/{{$discussion->user->image}}" alt="Profile Image" class="rounded" height="50%" width="100%" style="max-height:120px;max-width:120px;"><br>
            </div>
            <span style="color: goldenrod;font-weight: bold;width:100%;">{{ $discussion->user->name }}
                <span>
                    @if (Gate::forUser($discussion->user)->allows('official-publisher', $discussion->user))
                        <i class="fas fa-user-check"></i>
                    @endif   
                </span>
            </span><br>
            @foreach($discussion->user->roles as $role)
                <div>
                    <span style="font-style: italic;color: grey;">{{ $role->name }}</span>
                    
                    @if(!$loop->last)
                    ,
                    @endif
                </div>
            @endforeach
        </div>
        <div class="col-12 col-md-12 col-lg-10 col-xl-10" style="background-color: #B6B8D6;">
            <div class="row border-bottom border-dark">
                <div class="col-6 col-md-6 col-lg-9 col-xl-9">
                    <p>{{ date('M dS, g:iA' ,strtotime($discussion->created_at)) }}</p>
                </div>
                <div class="col-3 col-md-3 col-lg-3 col-xl-3 d-flex">
                    @can('update', $discussion)
                        <div class="mx-1">
                            <a href="/forums/{{$discussion->slug}}/edit" role="button" class="btn btn-secondary m-2"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    @endcan
                    @can('delete', $discussion)
                        <div>
                            {!!Form::open(['action' => ['DiscussionController@destroy', $discussion->id ], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::button('<i class="fas fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-secondary m-2'])}}
                            {!!Form::close()!!}
                        </div>
                    @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-auto ml-auto">
                    <span class="text-center"><button class="btn p-0 m-1" v-on:click="seen = !seen"><i class="fas fa-reply"></i> Reply</button></span>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p>{!! $discussion->body !!}</p>
                </div>
            </div>
        </div>
    </div>
    <hr style="background-color: red;">
    @guest
        <div class="row mr-0 mb-5">
            <div  id="reply-form" class="col-md-12 col-md-offset-2 pr-0">
                <p class="text-white text-center">Please <a href="{{ route('login') }}">login</a> to reply!</p>
            </div>
        </div>
    @else
        <div class="row mr-0 mb-5">
            <div id="reply-form" class="col-md-12 col-md-offset-2 pr-0" v-show="seen">
                {!! Form::open(['action' => ['ReplyController@store', $discussion->id], 'method' => 'POST']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            {{Form::textarea('body', null, ['class' => 'form-control', 'id' => 'replyBody', 'placeholder' => 'What is on your mind?...'])}}

                            {{Form::submit('Reply', ['class' => 'btn btn-dark btn-block', 'style' => 'color: white;font-weight: bold;'])}}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @endguest
    @foreach ($replies as $reply)
    <div class="row ml-0 mt-0 mb-2 mr-0" style="background-color: lightgrey;">
        <div class="col-12 col-md-12 col-lg-2 col-xl-2 text-center mx-auto p-1">
            <div class="p-2">
                <img src="/storage/profile/{{$reply->user->image}}" alt="Profile Image" class="rounded" height="50%" width="100%" style="max-height:120px;max-width:120px;"><br>
            </div>
            <span style="color: goldenrod;font-weight: bold;width:100%;">{{ $reply->user->name }}</span><br>
            @foreach($reply->user->roles as $role)
                <div>
                    <span style="font-style: italic;color: grey;">{{ $role->name }}</span>
                    
                    @if(!$loop->last)
                    ,
                    @endif
                </div>
            @endforeach
        </div>
        <div class="col-12 col-md-12 col-lg-10 col-xl-10" style="background-color: #E4DEE4;">
            <div class="row border-bottom border-dark">
                <div class="col-6 col-md-6 col-lg-9 col-xl-9">
                    <p>{{ date('M dS, g:iA' ,strtotime($reply->created_at)) }}</p>
                </div>
                <div class="col-3 col-md-3 col-lg-3 col-xl-3 d-flex">
                    @can('update', $reply)
                        <div class="mx-1">
                            <a href="/forums/reply_id/edit" role="button" class="btn btn-secondary m-2"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    @endcan
                    @can('delete', $reply)
                        <div>
                            {!!Form::open(['action' => ['ReplyController@destroy', $reply->id ], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::button('<i class="fas fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-secondary m-2'])}}
                            {!!Form::close()!!}
                        </div>
                    @endcan
                </div>
            </div>
            <div id="reply-functionality">
                <div class="row" id="reply-button">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <p>
                                    {!!$reply->body!!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $replies->links() }}
        </div>
    </div>
@endsection


@section('editor-js')
<script src="https://cdn.tiny.cloud/1/ijfbgkzbhtffss6jx1a1jcgeuxzesckga022eg6os2bg3xjl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#replyBody',
        width: "100%",
        menubar: 'file edit view format',
        toolbar: 'undo redo | bold | align | casechange checklist pageembed table media tinymcespellchecker',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
    tinymce.init({
        selector: 'textarea#replyBodyTwo',
        width: "100%",
        menubar: 'file edit view format',
        toolbar: 'undo redo | bold | align | casechange checklist pageembed table media tinymcespellchecker',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
    });
  </script>
@endsection

