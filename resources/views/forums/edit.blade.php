<div class="container">
    {!! Form::open(['action' => ['DiscussionController@update', $discussion->slug], 'files' => true, 'method' => 'POST']) !!}
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
            {{ Form::label('title', 'Discussion Title')}}
            {{ Form::text('title', $discussion->title, ['class' => 'form-control', 'placeholder' => 'Discussion Title']) }}
        </div>
        <div class="form-group row">
            {{ Form::label('body', 'Discussion Content')}}
            {{ Form::textarea('body', $discussion->body, ['class' => 'form-control', 'placeholder' => 'Discussion Content', 'id' => 'discussionBody'])}}
        </div>  
        {{ Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!!Form::close() !!}
</div>
