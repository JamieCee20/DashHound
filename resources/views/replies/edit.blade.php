<div class="container">
    {!! Form::open(['action' => ['ReplyController@update', $reply->id], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group row">
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
        <div class="form-group row">
            {{ Form::label('body', 'Reply Content')}}
            {{ Form::textarea('body', $reply->body, ['class' => 'form-control', 'placeholder' => 'What\'s on your mind?...', 'id' => 'replyBodyInEdit'])}}
        </div>  
        {{ Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!!Form::close() !!}
</div>

