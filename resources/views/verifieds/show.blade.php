@extends('layouts.app')
@section('title', 'Published Posts')

@section('content')
<div class="p-2 mx-3 text-white bg-secondary rounded" style="border: 2px solid #B6B8D6;">
    <div class="row">
        <div class="col-12 col-md-12 col-sm-12 col-lg-8">
            <img src="/storage/posts/{{ $verified->image }}" class="w-100 rounded" style="border: 4px solid #B6B8D6;">
        </div>
        <div class="col-12 col-md-12 col-sm-12 col-lg-4">
            <div class="post-buttons">
                <div class="d-flex align-items-center">
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{$verified->user->id}}"><span class="text-white">{{$verified->user->name}}</span></a>
                            @can('update', $verified)
                                <a href="/v/{{$verified->id}}/edit">Edit Post</a>
                            @endcan    
                        </div>
                        <div class="row">
                            <div class="ml-3 pt-3">
                                <span class="like-btn d-flex">
                                    <a class="likeButton" href=""><i class="fas fa-thumbs-up mr-2"></i></a><div>5 Total Likes</div> <!-- Fix issue not being able to use Laravel-like API -->
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="splitter">

                <p class="postDesc pb-4"><span class="font-weight-bold text-white">{{$verified->title}}: </span><br>
                    <span class="overflow-auto">{{$verified->description}}</span><br><br>
                    <span class="font-italic text-center" style="color:white;opacity:0.5;">posted on {{ date('F dS, Y - g:iA' ,strtotime($verified->created_at)) }}</span>
                </p>

                <div class="container bottom-link">
                    <button class="btn btn-info float-right mr-5"><a href="/v/posts" style="color:white;text-decoration: none;">Go Back</a></button>
                    @can('delete', $verified)
                        {!!Form::open(['action' => ['VerifiedController@destroy', $verified->id ], 'method' => 'POST'])!!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-info float-left', 'style' => 'color:white;text-decoration: none;'])}}
                        {!!Form::close()!!}
                    @endcan
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
