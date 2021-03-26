<div class="container">
    {!! Form::open(['action' => ['PostsController@update', $post->slug ], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('title', 'Post Title')}}
            {{ Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Post Title' ]) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description')}}
            {{ Form::textarea('description', $post->description, ['class' => 'form-control', 'placeholder' => 'Post Description' ])}}
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image')}}<br>
            <img src="/storage/posts/{{$post->image}}" height="25%" width="25%" alt="Post Image">
            <span>File Name: {{$post->image}}</span>
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        <div class="form-group row">
            <div class="row">
                <div class="col-12">
                    {{ Form::label('spoilers', 'Mark this with spoilers?')}}
                </div>
                <div class="col-12">
                    {{ Form::label('#true-statement', 'Yes')}}
                    {{ Form::radio('spoilers', 'true', false, ['id' => 'true-statement'])}}
                </div>
                <div class="col-12">
                    {{ Form::label('#false-statement', 'No')}}
                    {{ Form::radio('spoilers', 'false', true, ['id' => 'false-statement'])}}
                </div>
            </div>
        </div>
        {{ Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
</div>

