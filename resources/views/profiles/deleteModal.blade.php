<div class="container text-center">
  {!!Form::open(['action' => ['ProfilesController@destroy', $user->username ], 'method' => 'POST'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Remove Account', ['class' => 'btn btn-danger', 'style' => 'color:white;text-decoration: none;'])}}
  {!!Form::close()!!}
</div>