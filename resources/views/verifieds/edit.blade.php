<div class="container" style="color: black;">
    {!! Form::open(['action' => ['VerifiedController@update', $verified->id ], 'files' => true, 'method' => 'POST']) !!}
        <div class="form-group row">
            {{ Form::label('title', 'Post Title')}}
            {{ Form::text('title', $verified->title, ['class' => 'form-control', 'placeholder' => 'Post Title' ]) }}
        </div>
        <div class="form-group row">
            {{ Form::label('description', 'Post Description')}}
            {{ Form::textarea('description', $verified->description, ['class' => 'form-control', 'placeholder' => 'Post Description' ])}}
        </div>
        <div class="form-group row">
            {{ Form::label('image', 'Post Image')}}
            {{ Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        {{ Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
</div>

