@extends('layouts.app')
@section('title', 'Published Posts')

@section('content')
<div class="container text-white mb-5">
    <div class="row">
        <div class="col-12 mx-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12 mx-2">
            <button class="btn btn-outline-secondary mr-5"><a href="/v/posts" style="color:white;text-decoration: none;">Go Back</a></button>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mx-2">
            <h1>
                <span class="text-info" style="font-size: 3.25em;font-weight: 900; line-height: 1.12;margin:0px 0px 15px;">{{$verified->title}}</span>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12 col-lg-12 mx-2">
            <img src="/storage/posts/{{ $verified->image }}" class="w-100 rounded" width="100%" height="100%" style="border: 1px solid #888888;box-shadow: 5px 5px #C0C0C0;">
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-3" style="color: red;">
            <span style="font-size: 24px;">By <a href="{{route('profiles.show', $verified->user->username)}}" style="text-decoration: none;color: red;">{{$verified->user->username}}</a></span>
            @can('update', $verified)
                {{-- <a href="/v/{{$verified->id}}/edit">Edit Post</a> --}}
                <button type="button" class="mr-2 pt-1" style="background:none;border:none;padding:0;font-family:arial, sans-serif;color:#90D9D6;text-decoration:none;" data-toggle="modal" data-target="#editVerifiedModal">
                    Edit
                </button>
            @endcan
        </div>
        <div class="col-md-5" style="color: red;">
            <span style="font-size: 24px;"><i class="fas fa-edit"></i> Updated: {{date('F dS, Y - g:iA' ,strtotime($verified->updated_at))}}</span>
        </div>
        <div class="col-md-4" style="color: #888888;">
            <span style="font-size: 24px;"><i class="fas fa-check-circle"></i> Created: {{date('F dS, Y - g:iA' ,strtotime($verified->created_at))}}</span>
        </div>
    </div>
    <hr class="splitter" style="background-color: #fff;">
    <div class="row">
        <div class="col-12 d-flex">
            <span class="like-btn d-flex mx-2">
                <a class="like" href="/v/toggleLike/{{$verified->id}}"><i class="fas fa-thumbs-up mr-2"></i></a><div>{{ $likes->count() }} like(s)</div>
            </span>
            @can('delete', $verified)
                {!!Form::open(['action' => ['VerifiedController@destroy', $verified->id ], 'method' => 'POST'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger', 'style' => 'color:white;text-decoration: none;'])}}
                {!!Form::close()!!}
            @endcan
        </div>
    </div>
    <div class="row">
        <div class="col-12 mx-2">
            <h2 style="font-weight: normal;line-height:1.08;margin:20px 0px 0px;rgb(124,125,125);">{{$verified->description}}</h2>
        </div>
    </div>

    <!-- Edit Post Modal -->
    <div class="modal fade" id="editVerifiedModal" tabindex="-1" role="dialog" aria-labelledby="editVerifiedModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="color: black;" id="editVerifiedModalLabel">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('verifieds.edit')
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {     


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('i.glyphicon-thumbs-up, i.glyphicon-thumbs-down').click(function(){    
            var id = $(this).parents(".panel").data('id');
            var c = $('#'+this.id+'-bs3').html();
            var cObjId = this.id;
            var cObj = $(this);


            $.ajax({
               type:'POST',
               url:'/ajaxRequest',
               data:{id:id},
               success:function(data){
                  if(jQuery.isEmptyObject(data.success.attached)){
                    $('#'+cObjId+'-bs3').html(parseInt(c)-1);
                    $(cObj).removeClass("like-post");
                  }else{
                    $('#'+cObjId+'-bs3').html(parseInt(c)+1);
                    $(cObj).addClass("like-post");
                  }
               }
            });


        });      


        $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });                                        
    }); 
</script>
@endsection
