@extends('layouts.app')
@section('title', 'Ticketing System')

@section('content')
    <div class="container bg-secondary pb-5" style="height:100vh;">
        <div class="row bg-light">
            <h1 class="px-5">
                Tickets
            </h1>
        </div>
        @foreach ($tickets as $ticket)
            <div class="row mx-2 my-2 border rounded">
                <div class="col-12">
                    <div class="row bg-light">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-3 border-right">
                                    <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                                </div>
                                <div class="col-9">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4><strong>{{$ticket->title}}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            @if(strlen($ticket->body) > 200)
                                                {{substr($ticket->body, 0, 200)}}...
                                            @else
                                                {{$ticket->body}}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-top">
                                <div class="col-2 border-right">
                                    Actions <i class="fas fa-caret-down"></i>
                                </div>
                                <div class="col-3 border-right">
                                    <strong>Assigned to: </strong> {{$ticket->asignee->name}}
                                </div>
                                <div class="col-3 border-right">
                                    <strong>Raised by: </strong> {{$ticket->user->name}}
                                </div>
                                <div class="col-2 border-right">
                                    <strong>Issue: </strong>{{$ticket->category->name}}
                                </div>
                                <div class="col-2">
                                    <strong>Status: </strong>{{$ticket->status->name}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="row mx-2 my-2 border rounded">
            <div class="col-12">
                <div class="row bg-light">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 border-right">
                                #SHDGFUSKSNSCGCS
                            </div>
                            <div class="col-9">
                                Why Is this the first ticket created?
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-2 border-right">
                                Actions <i class="fas fa-caret-down"></i>
                            </div>
                            <div class="col-3 border-right">
                                Asignee
                            </div>
                            <div class="col-3 border-right">
                                Raised By
                            </div>
                            <div class="col-2 border-right">
                                Category
                            </div>
                            <div class="col-2">
                                Status
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-2 my-2 border rounded">
            <div class="col-12">
                <div class="row bg-light">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 border-right">
                                #JSHCSCHJBASHCBAS
                            </div>
                            <div class="col-9">
                                May as well have a second query title
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-2 border-right">
                                Actions <i class="fas fa-caret-down"></i>
                            </div>
                            <div class="col-3 border-right">
                                Asignee
                            </div>
                            <div class="col-3 border-right">
                                Raised By
                            </div>
                            <div class="col-2 border-right">
                                Category
                            </div>
                            <div class="col-2">
                                Status
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mx-2 my-2 border rounded">
            <div class="col-12">
                <div class="row bg-light">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 border-right">
                                #MSMACUBAHCJASCASCA
                            </div>
                            <div class="col-9">
                                And a final THIRD query title for this specific ticket
                            </div>
                        </div>
                        <div class="row border-top">
                            <div class="col-2 border-right">
                                Actions <i class="fas fa-caret-down"></i>
                            </div>
                            <div class="col-3 border-right">
                                Asignee
                            </div>
                            <div class="col-3 border-right">
                                Raised By
                            </div>
                            <div class="col-2 border-right">
                                Category
                            </div>
                            <div class="col-2">
                                Status
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection