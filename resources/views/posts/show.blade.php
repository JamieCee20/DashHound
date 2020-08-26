@extends('layouts.app')
@section('title', 'View Post')

@section('content')
@if($post->spoilers == '1')
<div class="container" id="spoilers">
    <spoiler-content>
        <div id="pageSpoiler">
            <div class="p-2 mx-3 text-white bg-secondary rounded" style="border: 2px solid #B6B8D6;">
                <div class="row">
                    <div class="col-12 col-md-12 col-sm-12 col-lg-8">
                        <img src="/storage/posts/{{ $post->image }}" class="w-100 rounded-circle" style="border: 4px solid #B6B8D6;">
                    </div>
                    <div class="col-12 col-md-12 col-sm-12 col-lg-4">
                        <div class="post-buttons">
                            <div class="d-flex align-items-center">
                                <div>
                                    <div class="font-weight-bold">
                                        <a href="/profile/{{$post->user->id}}"><span class="text-white">{{$post->user->name}}</span></a>
                                        @can('update', $post)
                                            <a href="/p/{{$post->title}}/edit">Edit Post</a>
                                        @endcan    
                                    </div>
                                </div>
                            </div>
        
                            <hr class="splitter">
        
                            <p class="postDesc pb-4"><span class="font-weight-bold text-white">{{$post->user->name}}: </span>
                                <span class="overflow-auto">{{$post->description}}</span>
                                <span class="font-italic text-center" style="color:white;opacity:0.5;">posted on {{ date('F dS, Y - g:iA' ,strtotime($post->created_at)) }}</span>
                            </p>
        
                            <div class="container bottom-link">
                                <button class="btn btn-info float-right mr-5"><a href="/posts" style="color:white;text-decoration: none;">Go Back</a></button>
                                @can('delete', $post)
                                    {!!Form::open(['action' => ['PostsController@destroy', $post->id ], 'method' => 'POST'])!!}
                                        {{Form::hidden('_method', 'DELETE')}}
                                        {{Form::submit('Delete', ['class' => 'btn btn-info float-left', 'style' => 'color:white;text-decoration: none;'])}}
                                    {!!Form::close()!!}
                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <br>
        
            <div class="p-2 mx-3  mb-5 text-white bg-secondary white rounded" style="border: 2px solid #B6B8D6;">
                <div class="row">
                    <div class="col-12 col-offset-2">
                        <h2 class="text-center font-italic">Comments: </h2>
                        <p class="font-italic text-center" style="color:white;opacity:0.5;"><img src="/storage/comment.svg" class="mr-3" height="20px" width="20px">{{$comments->count()}} total comments</p>
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-md-12 col-md-offset-2 text-center">
                        <button class="btn btn-outline-light" type="button" data-toggle="collapse" data-target="#comments" aria-expanded="true" aria-controls="comments">&#9660; Toggle Comments &#9660;</button>
                    </div>
                </div>
                <div class="row collapse" id="comments">
                    <div class="col-md-12 col-md-offset-2" >
                        @foreach($comments as $comment)
                            <div class="comment my-5">
                                <div class="author-info">
                                    <img class="author-image" src="/storage/profile/{{$comment->user->image}}" alt="Profile Image">
                                    <div class="author-name">
                                        <h4>{{$comment->name}}</h4>
                                        <p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
                                    </div>
                                </div>
                                <div class="comment-content">
                                    {{$comment->comment}}
                                </div>
                                    <div class="d-flex" style="margin-left:65px;">
                                        @can('update', $comment)
                                            <button class="mr-2 pt-1" style="background:none;border:none;padding:0;font-family:arial, sans-serif;color:#90D9D6;text-decoration:none;"><a href="/comment/{{$comment->id}}/edit">Edit</a></button>
                                        @endcan
                                        @can('delete', $comment)
                                            {!!Form::open(['action' => ['CommentsController@destroy', $comment->id ], 'method' => 'POST'])!!}
                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class' => 'align-items-bottom mr-2 pt-1', 'style' => 'background:none;border:none;padding:0;font-family:arial, sans-serif;color:red;text-decoration:none;'])}}
                                            {!!Form::close() !!}
                                        @endcan
                                    </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
        
                <hr class="splitter">
        
                <div class="row">
                    <div  id="comment-form" class="col-md-12 col-md-offset-2">
                        {!! Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST']) !!}
                            <div class="row">
                                <div class="col-md-12">
                                    {{Form::label('comment', 'Comment: ')}}
                                    {{Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])}}
        
                                    {{Form::submit('Add Comment', ['class' => 'btn btn-success btn-block mt-3'])}}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </spoiler-content>
</div>
@else
<div class="p-2 mx-3 text-white bg-secondary rounded" style="border: 2px solid #B6B8D6;">
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12 col-lg-8">
            <img src="/storage/posts/{{ $post->image }}" class="w-100 rounded-circle" style="border: 4px solid #B6B8D6;">
        </div>
        <div class="col-12 col-md-12 col-sm-12 col-lg-4">
            <div class="post-buttons">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$post->user->id}}"><span class="text-white">{{$post->user->name}}</span></a>
                            @can('update', $post)
                                <a href="/p/{{$post->title}}/edit">Edit Post</a>
                            @endcan    
                        </div>
                    </div>
                </div>

                <hr class="splitter">

                <p class="postDesc pb-4"><span class="font-weight-bold text-white">{{$post->user->name}}: </span>
                    <span class="overflow-auto">{{$post->description}}</span>
                    <span class="font-italic text-center" style="color:white;opacity:0.5;">posted on {{ date('F dS, Y - g:iA' ,strtotime($post->created_at)) }}</span>
                </p>

                <div class="container bottom-link">
                    <button class="btn btn-info float-right mr-5"><a href="/posts" style="color:white;text-decoration: none;">Go Back</a></button>
                    @can('delete', $post)
                        {!!Form::open(['action' => ['PostsController@destroy', $post->id ], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-info float-left', 'style' => 'color:white;text-decoration: none;'])}}
                        {!!Form::close()!!}
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

<br>

<div class="p-2 mx-3  mb-5 text-white bg-secondary white rounded" style="border: 2px solid #B6B8D6;">
    <div class="row">
        <div class="col-12 col-offset-2">
            <h2 class="text-center font-italic">Comments: </h2>
            <p class="font-italic text-center" style="color:white;opacity:0.5;"><img src="/storage/comment.svg" class="mr-3" height="20px" width="20px">{{$comments->count()}} total comments</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-md-offset-2 text-center">
            <button class="btn btn-outline-light" type="button" data-toggle="collapse" data-target="#comments" aria-expanded="true" aria-controls="comments">&#9660; Toggle Comments &#9660;</button>
        </div>
    </div>
    <div class="row collapse" id="comments">
        <div class="col-md-12 col-md-offset-2" >
            @foreach($comments as $comment)
                <div class="comment my-5">
                    <div class="author-info">
                        <img class="author-image" src="/storage/profile/{{$comment->user->image}}" alt="Profile Image">
                        <div class="author-name">
                            <h4>{{$comment->name}}</h4>
                            <p class="author-time">{{ date('F nS, Y - g:iA' ,strtotime($comment->created_at)) }}</p>
                        </div>
                    </div>
                    <div class="comment-content">
                        {{$comment->comment}}
                    </div>
                        <div class="d-flex" style="margin-left:65px;">
                            @can('update', $comment)
                                <button class="mr-2 pt-1" style="background:none;border:none;padding:0;font-family:arial, sans-serif;color:#90D9D6;text-decoration:none;"><a href="/comment/{{$comment->id}}/edit">Edit</a></button>
                            @endcan
                            @can('delete', $comment)
                                {!!Form::open(['action' => ['CommentsController@destroy', $comment->id ], 'method' => 'POST'])!!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                    {{Form::submit('Delete', ['class' => 'align-items-bottom mr-2 pt-1', 'style' => 'background:none;border:none;padding:0;font-family:arial, sans-serif;color:red;text-decoration:none;'])}}
                                {!!Form::close() !!}
                            @endcan
                        </div>
                </div>
            @endforeach
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>

    <hr class="splitter">

    <div class="row">
        <div  id="comment-form" class="col-md-12 col-md-offset-2">
            {!! Form::open(['action' => ['CommentsController@store', $post->id], 'method' => 'POST']) !!}
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('comment', 'Comment: ')}}
                        {{Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5'])}}

                        {{Form::submit('Add Comment', ['class' => 'btn btn-success btn-block mt-3'])}}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

</div>
@endif
@endsection
