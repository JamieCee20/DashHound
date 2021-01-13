@extends('layouts.app')
@section('title', 'Ticket Display')

@section('content')
    @if (Auth::user()->hasAnyRoles(['owner', 'administrator']))
        <div class="row">
            <a class="px-3" href="{{route('tickets.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
            <div class="col-12">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="border rounded ticket-information">
                            <div class="ticket-information-header px-2">
                                <div class="row">
                                    <div class="col-10">
                                        <h3><i class="fas fa-ticket-alt"></i> Ticket Information</h3>
                                    </div>
                                    <div class="col-2">
                                        <div class="ticket-information-cursor" v-on:click="information = !information">
                                            <i class="fas fa-chevron-up" v-if="information"></i>
                                            <i class="fas fa-chevron-down" v-if="!information"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <transition name="slide">
                                <div class="ticket-information-body" v-if="information">
                                    <div class="ticket-information-one border-bottom">
                                        <p class="px-2">
                                            <span class="text-muted">#{{$ticket->ticket_id}}</span> - {{$ticket->title}}
                                        </p>
                                    </div>
                                    <div class="ticket-information-department border-bottom">
                                        <p class="text-muted px-2">
                                            Department
                                        </p>
                                        <p class="px-2">
                                            {{$ticket->category->name}}
                                        </p>
                                    </div>
                                    <div class="ticket-information-submitted border-bottom">
                                        <p class="text-muted px-2">
                                            Submitted
                                        </p>
                                        <p class="px-2">
                                            {{ date('M dS, Y (H:i)' ,strtotime($ticket->created_at)) }}
                                        </p>
                                    </div>
                                    <div class="ticket-information-status border-bottom pb-2">
                                        <p class="px-2 text-muted">
                                            Status
                                        </p>
                                        <div class="mx-2 px-2 rounded" style="width: 20%; background-color: {{$ticket->status->color}}">
                                            {{$ticket->status->name}}
                                        </div>
                                    </div>
                                    <div class="ticket-information-assignee border-bottom pb-2">
                                        <p class="px-2 text-muted">
                                            Assign Staff
                                        </p>                               
                                        <div class="dropdown show px-2">
                                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            @if ($ticket->manager_id !== null)
                                                {{$ticket->assignee->name}}
                                            @else
                                                Assign Staff Member
                                            @endif
                                            </a>
                                        
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                @foreach ($staffUsers as $staff)
                                                    <a class="dropdown-item" href="/ticket/assign/{{$staff->id}}/{{$ticket->ticket_id}}">{{$staff->name}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                            <div class="ticket-information-header px-2 py-2">
                                <div class="row justify-content-center text-center">
                                    <div class="col-6 col-md-6">
                                        @if ($ticket->status->name == "Closed")
                                            <button class="btn btn-success" style="width: 100%;" disabled="disabled">Reply</button>
                                        @else 
                                            <a href="#ticketReplyBox" class="btn btn-success" style="width: 100%;">Reply</a>
                                        @endif
                                    </div>
                                    <div class="col-6 col-md-6">
                                        @if ($ticket->status->name == "Closed")
                                            <button class="btn btn-danger" style="width: 100%;" disabled="disabled">Closed</button>
                                        @else
                                            <a href="/ticket/close/{{$ticket->ticket_id}}" class="btn btn-danger" style="width: 100%;">Close</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="ticket-content my-2 mx-2">
                            <div class="ticket-content-header">
                                <h2 class="ticket-header-title">View Ticket</h2>
                            </div>
                            @if ($ticket->status->name == "Closed")
                                <div class="ticket-content-status">
                                    <p class="alert-warning text-center rounded" style="padding: 20px 0;">This ticket has been closed!</p>
                                </div>
                            @endif
                            <div class="ticket-content-query rounded">
                                <div class="ticket-content-author rounded">
                                    <div class="h5 ticket-content-author-header p-3">
                                        <i class="fas fa-user"></i> {{$ticket->user->name}} - 
                                        @foreach($ticket->user->roles as $role)
                                            <span style="font-style: italic;">{{ $role->name }}</span>
                                            
                                            @if(!$loop->last)
                                            ,
                                            @endif
                                        @endforeach
                                        <div class="float-right" style="font-size: 12px;">
                                            {{ date('d/m/Y (H:i)' ,strtotime($ticket->created_at)) }}
                                        </div>
                                    </div>
                                    <div class="ticket-body px-2">
                                        @foreach ($ticketbodies as $body)
                                            @if ($body->user_id === $ticket->user_id)
                                                <div class="user-body my-2">
                                                    <h5 class="p-2 user-header">
                                                        {{$body->user->name}} - Client
                                                        <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                    </h5>
                                                    <p class="p-2 user-reply">
                                                        {{ $body->body }}
                                                    </p>
                                                    @if ($body->image !== null)
                                                        <p class="border-top">
                                                            <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                        </p>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="staff-body my-2">
                                                    <h5 class="p-2 staff-header">
                                                        {{$body->user->name}} - Staff
                                                        <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                    </h5>
                                                    <p class="p-2 staff-reply">
                                                        {{ $body->body }}
                                                    </p>
                                                    @if ($body->image !== null)
                                                        <p class="border-top">
                                                            <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="ticketReplyBox">
            <div class="col-12 px-4">
                {!! Form::open(['action' => 'TicketBodyController@store', 'files' => true, 'method' => 'POST']) !!}
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
                        {{ Form::hidden('ticket_id', $ticket->id) }}
                    </div>
                    <div class="form-group row">
                        {{ Form::label('body', 'Your reply')}}
                        {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Reply here...', 'id' => 'replyBody'])}}
                    </div>   
                    {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
                {!!Form::close() !!}
            </div>
        </div>
    @elseif(Auth::user()->hasAnyRoles(['moderator']))
        @if (Auth::user()->id !== $ticket->manager_id)
            <div class="row">
                <a class="px-3" href="{{route('tickets.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                <div class="col-12">
                    <p class="alert-danger text-center rounded" style="padding: 20px 0;">You are not authorized to view this ticket.</p>
                </div>
            </div>
        @else
            <div class="row">
                <a class="px-3" href="{{route('tickets.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="border rounded ticket-information">
                                <div class="ticket-information-header px-2">
                                    <div class="row">
                                        <div class="col-10">
                                            <h3><i class="fas fa-ticket-alt"></i> Ticket Information</h3>
                                        </div>
                                        <div class="col-2">
                                            <div class="ticket-information-cursor" v-on:click="information = !information">
                                                <i class="fas fa-chevron-up" v-if="information"></i>
                                                <i class="fas fa-chevron-down" v-if="!information"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <transition name="slide">
                                    <div class="ticket-information-body" v-if="information">
                                        <div class="ticket-information-one border-bottom">
                                            <p class="px-2">
                                                <span class="text-muted">#{{$ticket->ticket_id}}</span> - {{$ticket->title}}
                                            </p>
                                        </div>
                                        <div class="ticket-information-department border-bottom">
                                            <p class="text-muted px-2">
                                                Department
                                            </p>
                                            <p class="px-2">
                                                {{$ticket->category->name}}
                                            </p>
                                        </div>
                                        <div class="ticket-information-submitted border-bottom">
                                            <p class="text-muted px-2">
                                                Submitted
                                            </p>
                                            <p class="px-2">
                                                {{ date('M dS, Y (H:i)' ,strtotime($ticket->created_at)) }}
                                            </p>
                                        </div>
                                        <div class="ticket-information-status border-bottom pb-2">
                                            <p class="px-2 text-muted">
                                                Status
                                            </p>
                                            <div class="mx-2 px-2 rounded" style="width: 20%; background-color: {{$ticket->status->color}}">
                                                {{$ticket->status->name}}
                                            </div>
                                        </div>
                                    </div>
                                </transition>
                                <div class="ticket-information-header px-2 py-2">
                                    <div class="row justify-content-center text-center">
                                        <div class="col-6 col-md-6">
                                            @if ($ticket->status->name == "Closed")
                                                <button class="btn btn-success" style="width: 100%;" disabled="disabled">Reply</button>
                                            @else 
                                                <a href="#ticketReplyBox" class="btn btn-success" style="width: 100%;">Reply</a>
                                            @endif
                                        </div>
                                        <div class="col-6 col-md-6">
                                            @if ($ticket->status->name == "Closed")
                                                <button class="btn btn-danger" style="width: 100%;" disabled="disabled">Closed</button>
                                            @else
                                                <a href="/ticket/close/{{$ticket->ticket_id}}" class="btn btn-danger" style="width: 100%;">Close</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="ticket-content my-2 mx-2">
                                <div class="ticket-content-header">
                                    <h2 class="ticket-header-title">View Ticket</h2>
                                </div>
                                @if ($ticket->status->name == "Closed")
                                    <div class="ticket-content-status">
                                        <p class="alert-warning text-center rounded" style="padding: 20px 0;">This ticket has been closed!</p>
                                    </div>
                                @endif
                                <div class="ticket-content-query rounded">
                                    <div class="ticket-content-author rounded">
                                        <div class="h5 ticket-content-author-header p-3">
                                            <i class="fas fa-user"></i> {{$ticket->user->name}} - 
                                            @foreach($ticket->user->roles as $role)
                                                <span style="font-style: italic;">{{ $role->name }}</span>
                                                
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                            @endforeach
                                            <div class="float-right" style="font-size: 12px;">
                                                {{ date('d/m/Y (H:i)' ,strtotime($ticket->created_at)) }}
                                            </div>
                                        </div>
                                        <div class="ticket-body px-2">
                                            @foreach ($ticketbodies as $body)
                                                @if ($body->user_id === $ticket->user_id)
                                                    <div class="user-body my-2">
                                                        <h5 class="p-2 user-header">
                                                            {{$body->user->name}} - Client
                                                            <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                        </h5>
                                                        <p class="p-2 user-reply">
                                                            {{ $body->body }}
                                                        </p>
                                                        @if ($body->image !== null)
                                                            <p class="border-top">
                                                                <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                            </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="staff-body my-2">
                                                        <h5 class="p-2 staff-header">
                                                            {{$body->user->name}} - Staff
                                                            <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                        </h5>
                                                        <p class="p-2 staff-reply">
                                                            {{ $body->body }}
                                                        </p>
                                                        @if ($body->image !== null)
                                                            <p class="border-top">
                                                                <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="ticketReplyBox">
                <div class="col-12 px-4">
                    {!! Form::open(['action' => 'TicketBodyController@store', 'files' => true, 'method' => 'POST']) !!}
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
                            {{ Form::hidden('ticket_id', $ticket->id) }}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('body', 'Your reply')}}
                            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Reply here...', 'id' => 'replyBody'])}}
                        </div>   
                        {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
                    {!!Form::close() !!}
                </div>
            </div>
        @endif
    @else
        @if (Auth::user()->id !== $ticket->user_id)
            <div class="row">
                <a class="px-3" href="{{route('tickets.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                <div class="col-12">
                    <p class="alert-danger text-center rounded" style="padding: 20px 0;">You are not authorized to view this ticket.</p>
                </div>
            </div>
        @else 
            <div class="row">
                <a class="px-3" href="{{route('tickets.index')}}"><i class="fas fa-long-arrow-alt-left"></i> Back</a>
                <div class="col-12">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="border rounded ticket-information">
                                <div class="ticket-information-header px-2">
                                    <div class="row">
                                        <div class="col-10">
                                            <h3><i class="fas fa-ticket-alt"></i> Ticket Information</h3>
                                        </div>
                                        <div class="col-2">
                                            <div class="ticket-information-cursor" v-on:click="information = !information">
                                                <i class="fas fa-chevron-up" v-if="information"></i>
                                                <i class="fas fa-chevron-down" v-if="!information"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <transition name="slide">
                                    <div class="ticket-information-body" v-if="information">
                                        <div class="ticket-information-one border-bottom">
                                            <p class="px-2">
                                                <span class="text-muted">#{{$ticket->ticket_id}}</span> - {{$ticket->title}}
                                            </p>
                                        </div>
                                        <div class="ticket-information-department border-bottom">
                                            <p class="text-muted px-2">
                                                Department
                                            </p>
                                            <p class="px-2">
                                                {{$ticket->category->name}}
                                            </p>
                                        </div>
                                        <div class="ticket-information-submitted border-bottom">
                                            <p class="text-muted px-2">
                                                Submitted
                                            </p>
                                            <p class="px-2">
                                                {{ date('M dS, Y (H:i)' ,strtotime($ticket->created_at)) }}
                                            </p>
                                        </div>
                                        <div class="ticket-information-status border-bottom pb-2">
                                            <p class="px-2 text-muted">
                                                Status
                                            </p>
                                            <div class="mx-2 px-2 rounded" style="width: 20%; background-color: {{$ticket->status->color}}">
                                                {{$ticket->status->name}}
                                            </div>
                                        </div>
                                    </div>
                                </transition>
                                <div class="ticket-information-header px-2 py-2">
                                    <div class="row justify-content-center text-center">
                                        <div class="col-6 col-md-6">
                                            @if ($ticket->status->name == "Closed")
                                                <button class="btn btn-success" style="width: 100%;" disabled="disabled">Reply</button>
                                            @else 
                                                <a href="#ticketReplyBox" class="btn btn-success" style="width: 100%;">Reply</a>
                                            @endif
                                        </div>
                                        <div class="col-6 col-md-6">
                                            @if ($ticket->status->name == "Closed")
                                                <button class="btn btn-danger" style="width: 100%;" disabled="disabled">Closed</button>
                                            @else
                                                <a href="/ticket/close/{{$ticket->ticket_id}}" class="btn btn-danger" style="width: 100%;">Close</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-8">
                            <div class="ticket-content my-2 mx-2">
                                <div class="ticket-content-header">
                                    <h2 class="ticket-header-title">View Ticket</h2>
                                </div>
                                @if ($ticket->status->name == "Closed")
                                    <div class="ticket-content-status">
                                        <p class="alert-warning text-center rounded" style="padding: 20px 0;">This ticket has been closed!</p>
                                    </div>
                                @endif
                                <div class="ticket-content-query rounded">
                                    <div class="ticket-content-author rounded">
                                        <div class="h5 ticket-content-author-header p-3">
                                            <i class="fas fa-user"></i> {{$ticket->user->name}} - 
                                            @foreach($ticket->user->roles as $role)
                                                <span style="font-style: italic;">{{ $role->name }}</span>
                                                
                                                @if(!$loop->last)
                                                ,
                                                @endif
                                            @endforeach
                                            <div class="float-right" style="font-size: 12px;">
                                                {{ date('d/m/Y (H:i)' ,strtotime($ticket->created_at)) }}
                                            </div>
                                        </div>
                                        <div class="ticket-body px-2">
                                            @foreach ($ticketbodies as $body)
                                                @if ($body->user_id === $ticket->user_id)
                                                    <div class="user-body my-2">
                                                        <h5 class="p-2 user-header">
                                                            {{$body->user->name}} - Client
                                                            <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                        </h5>
                                                        <p class="p-2 user-reply">
                                                            {{$body->body}}
                                                        </p>
                                                        @if ($body->image !== null)
                                                            <p class="border-top">
                                                                <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                            </p>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="staff-body my-2">
                                                        <h5 class="p-2 staff-header">
                                                            {{ $body->user->name}} - Staff
                                                            <span class="float-right">{{ date('d/m/Y (H:i)' ,strtotime($body->created_at)) }}</span>
                                                        </h5>
                                                        <p class="p-2 staff-reply">
                                                            {{ $body->body }}
                                                        </p>
                                                        @if ($body->image !== null)
                                                            <p class="border-top">
                                                                <img class="p-2" src="/storage/ticketFile/{{$body->image}}" alt="ticket body image" height="75%" width="100%">
                                                            </p>
                                                        @endif
                                                    </div>
                                                @endif
                                            @endforeach
                                            <div class="row my-5">
                                                <div class="col-12 d-flex justify-content-center">
                                                    {{ $ticketbodies->links('vendor.pagination.simple-default') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" id="ticketReplyBox">
                <div class="col-12 px-4">
                    {!! Form::open(['action' => 'TicketBodyController@store', 'files' => true, 'method' => 'POST']) !!}
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
                            {{ Form::hidden('ticket_id', $ticket->id) }}
                        </div>
                        <div class="form-group row">
                            {{ Form::label('body', 'Your reply')}}
                            {{ Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Reply here...', 'id' => 'replyBody'])}}
                        </div>   
                        {{ Form::submit('Submit', ['class' => 'btn btn-outline-secondary']) }}
                    {!!Form::close() !!}
                </div>
            </div>
        @endif    
    @endif
@endsection
@section('editor-js')
<script src="https://cdn.tiny.cloud/1/ijfbgkzbhtffss6jx1a1jcgeuxzesckga022eg6os2bg3xjl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        force_p_newlines : false,
        force_br_newlines : true,
        convert_newlines_to_brs : false,
        remove_linebreaks : true,
        forced_root_block : '', 
        selector: 'textarea#replyBody',
        plugins: 'image',
        width: "100%",
        menubar: 'file edit view format insert',
        toolbar: 'undo redo | bold | align | image',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        /* enable title field in the Image dialog*/
        image_title: true,
        image_file_types: 'jpg,jpeg,svg,png',
        image_upload_url: '/ticketbodies',
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
            URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
            images_upload_url: 'postAcceptor.php',
            here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            /*
            Note: In modern browsers input[type="file"] is functional without
            even adding it to the DOM, but that might not be the case in some older
            or quirky browsers like IE, so you might want to add it to the DOM
            just in case, and visually hide it. And do not forget do remove it
            once you do not need it anymore.
            */

            input.onchange = function () {
            var file = this.files[0];

            var reader = new FileReader();
            reader.onload = function () {
                /*
                Note: Now we need to register the blob in TinyMCEs image blob
                registry. In the next release this part hopefully won't be
                necessary, as we are looking to handle it internally.
                */
                var id = 'blobid' + (new Date()).getTime();
                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                var base64 = reader.result.split(',')[1];
                var blobInfo = blobCache.create(id, file, base64);
                blobCache.add(blobInfo);

                /* call the callback and populate the Title field with the file name */
                cb(blobInfo.blobUri(), { title: file.name });
            };
            reader.readAsDataURL(file);
            };

            input.click();
        },
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
@endsection