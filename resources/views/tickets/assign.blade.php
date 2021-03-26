<div class="container">
    {!! Form::open(['action' => ['TicketController@assignUser', $ticket->ticket_id], 'method' => 'POST']) !!}
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
    @foreach ($staffUsers as $staff)
        <div class="form-group row">
            {{ Form::radio('staff', $staff->id) }}
            {{ Form::label('staff', $staff->username, ['class' => 'mx-2']) }}
        </div>
    @endforeach
    {{-- <div class="form-group row">
{{ $staffUsers->links() }}
</div> --}}
    {{ Form::hidden('_method', 'PATCH') }}
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{ Form::submit('Save Changes', ['class' => 'btn btn-primary']) }}
    </div>
    {!! Form::close() !!}
</div>
