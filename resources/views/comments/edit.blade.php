<div class="container text-white">
    {!! Form::open(['action' => ['CommentsController@update', $comment->id ], 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('comment', 'Comment: ')}}
            {{ Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'placeholder' => 'Comment' ])}}
        </div>
        {{Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
</div>