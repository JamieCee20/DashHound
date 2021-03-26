<div class="container">
    {!! Form::open(['action' => ['ProfilesController@update', $user->username], 'files' => true, 'method' => 'POST']) !!}
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
            {{Form::label('email', 'Your Email Address')}}
            {{Form::email('email', $user->email, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('username', 'Your Username')}}
            {{Form::text('username', $user->username, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('bio', 'Your Personal Description')}}
            {{Form::textarea('bio', $user->bio, ['class' => 'form-control'])}}
        </div>

        <div class="form-group row">
            {{Form::label('image', 'Profile Image', ['class' => 'mr-4'])}}
            <img src="/storage/profile/{{$user->image}}" height="25%" width="25%" alt="Post Image">
            <span>File Name: {{$user->image}}</span>
            {{Form::file('image', ['class' => 'form-control-file'])}}
        </div>
        {{Form::hidden('_method', 'PATCH')}}
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
        </div>
    {!! Form::close() !!}
</div>