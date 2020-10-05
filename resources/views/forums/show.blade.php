@extends('layouts.app')
@section('title', 'Forum Post')


@section('content')
    <div class="row" style="border: 1px solid lightgrey;background-color: lightgrey;box-shadow:5px 5px grey;">
        <div class="col-12 col-md-12 col-lg-2 col-xl-2 text-center mx-auto">
            <img src="/storage/profile/{{$discussion->user->image}}" alt="Profile Image" class="border rounded" height="50%" width="100%" style="max-height:120px;max-width:120px;"><br>
            <span style="color: goldenrod;font-weight: bold;width:100%;">{{ $discussion->user->name }}</span><br>
            @foreach($discussion->user->roles as $role)
                <div style="background: url('/storage/images/banner.png');">
                    <span style="font-style: italic;color: grey;">{{ $role->name }}</span>
                    
                    @if(!$loop->last)
                    ,
                    @endif
                </div>
            @endforeach
        </div>
        <div class="col-12 col-md-12 col-lg-10 col-xl-10" style="background-color: #B6B8D6;">
            <div class="row border-bottom border-dark">
                <div class="col-9">
                    <p>{{ date('M dS, g:iA' ,strtotime($discussion->created_at)) }}</p>
                </div>
                <div class="col-3 d-flex">
                    @can('update', $discussion)
                        <div class="mx-1">
                            <a href="#" role="button" class="btn btn-secondary"><i class="fas fa-edit"></i> Edit</a>
                        </div>
                    @endcan
                    @can('delete', $discussion)
                        <div>
                            {!!Form::open(['action' => ['DiscussionController@destroy', $discussion->id ], 'method' => 'POST'])!!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::button('<i class="fas fa-trash"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-secondary'])}}
                            {!!Form::close()!!}
                        </div>
                    @endcan
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
    <div class="row">
        <div class="col-12">
            <p>
                Content
            </p>
        </div>
    </div>
@endsection