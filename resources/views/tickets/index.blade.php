@extends('layouts.app')
@section('title', 'Ticketing System')

@section('content')
    <div class="container bg-secondary pb-5" style="height:100vh;">
        <div class="row bg-light">
            <div class="col-8">
                <h1 class="px-5">
                    Tickets
                </h1>
            </div>
            <div class="col-4 p-2">
                <a href="{{ route('tickets.create') }}" class="btn btn-outline-info float-right">Create Ticket</a>
            </div>
        </div>
        @if(Auth::user()->hasAnyRoles(['owner', 'administrator']))
            <div class="row">
                <div class="col-12 d-flex">
                    @if (!request()->staff)
                        <div class="dropdown p-2">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Category
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                @foreach($categories as $category)
                                    <a class="dropdown-item {{  setActiveCategory($category->id) }}" href="{{ route('tickets.index', ['category' => $category->id]) }}">{{$category->name}}</a>
                                @endforeach
                                <a class="dropdown-item" href="{{ route('tickets.index') }}">All</a>
                            </div>
                        </div>
                    @endif
                    @if (!request()->category)
                        <div class="dropdown p-2">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Filter
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu3">
                                @foreach($ticketStaff as $staff)
                                    @if ($staff->hasAnyRoles(['owner', 'administrator', 'moderator']))
                                        <a class="dropdown-item" href="{{ route('tickets.index', ['staff' => $staff->id]) }}">{{$staff->name}}</a>
                                    @endif
                                @endforeach    
                                <a class="dropdown-item" href="{{ route('tickets.index', ['staff' => 'empty']) }}">Not Assigned</a>
                                <a class="dropdown-item" href="{{ route('tickets.index') }}">All</a>
                            </div>
                        </div>  
                    @endif
                </div>
            </div>
            @forelse ($tickets as $ticket)
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-2 border-right">
                                        <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4><strong>{!! $ticket->title !!}</strong></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                @if(strlen($ticket->body) > 200)
                                                    {{substr($ticket->body, 0, 200)}}...
                                                @else
                                                    {{$ticket->body}}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1 border-left">
                                        <div class="float-right px-2">
                                            <i class="fas fa-comment-dots"></i>{{$ticket->ticketBodies->count()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top">
                                    <div class="col-lg-4 border-right text-center">
                                        @if ($ticket->manager_id !== null)
                                            <strong>Assigned to: </strong> {{$ticket->assignee->name}}
                                        @else
                                            <strong>Assigned to: </strong> TBC
                                        @endif
                                    </div>
                                    <div class="col-lg-4 border-right text-center">
                                        <strong>Raised by: </strong> {{$ticket->user->name}}
                                    </div>
                                    <div class="col-lg-2 border-right text-center">
                                        <strong>Issue: </strong>{{$ticket->category->name}}
                                    </div>
                                    <div class="col-lg-2 text-center" style="background-color: {{$ticket->status->color}}">
                                        <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty 
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <p>
                                    No Tickets under this category!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
            <div class="row my-5">
                <div class="col-12 d-flex justify-content-center">
                    {{ $tickets->links('vendor.pagination.simple-default') }}
                </div>
            </div>
        @elseif(Auth::user()->hasAnyRoles(['moderator']))
            <div class="row mx-2 my-2">
                <div class="col-12">
                    <div class="dropdown py-2">
                        <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Select Category
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            @foreach($categories as $category)
                                <a class="dropdown-item {{  setActiveCategory($category->id) }}" href="{{ route('tickets.index', ['category' => $category->id]) }}">{{$category->name}}</a>
                            @endforeach
                                <a class="dropdown-item {{  setActiveCategory($category->id) }}" href="{{ route('tickets.index', ['category' => 0]) }}">All</a>
                        </div>
                    </div>
                </div>
            </div>
            @forelse ($moderatortickets as $ticket)
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 border-right">
                                        <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4><strong>{!! $ticket->title !!}</strong></h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
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
                                    <div class="col-lg-4 border-right text-center">
                                        @if ($ticket->manager_id !== null)
                                            <strong>Assigned to: </strong> {{$ticket->assignee->name}}
                                        @else
                                            <strong>Assigned to: </strong> TBC
                                        @endif
                                    </div>
                                    <div class="col-lg-4 border-right text-center">
                                        <strong>Raised by: </strong> {{$ticket->user->name}}
                                    </div>
                                    <div class="col-lg-2 border-right text-center">
                                        <strong>Issue: </strong>{{$ticket->category->name}}
                                    </div>
                                    <div class="col-lg-2 text-center" style="background-color: {{$ticket->status->color}}">
                                        <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty 
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <p>
                                    No Tickets under this category!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
            <hr>
            <h4>Created Tickets</h4>
            @foreach ($usertickets as $ticket)
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 border-right">
                                        <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4><strong>{!! $ticket->title !!}</strong></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top">
                                    <div class="col-lg-5 border-right text-center">
                                        @if ($ticket->manager_id !== null)
                                            <strong>Staff member handling ticket: </strong> {{$ticket->assignee->name}}
                                        @else
                                            <strong>Staff member handling ticket: </strong> TBC
                                        @endif
                                    </div>
                                    <div class="col-lg-4 border-right text-center">
                                        <strong>Issue: </strong>{{$ticket->category->name}}
                                    </div>
                                    <div class="col-lg-3 text-center" style="background-color: {{$ticket->status->color}}">
                                        <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else 
            @foreach ($usertickets as $ticket)
                <div class="row mx-2 my-2 border rounded">
                    <div class="col-12">
                        <div class="row bg-light">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-3 border-right">
                                        <a href="{{route('tickets.show', $ticket->ticket_id)}}">#{{$ticket->ticket_id}}</a>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h4><strong>{!! $ticket->title !!}</strong></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row border-top">
                                    <div class="col-lg-5 border-right text-center">
                                        @if ($ticket->manager_id !== null)
                                            <strong>Staff member handling ticket: </strong> {{$ticket->assignee->name}}
                                        @else
                                            <strong>Staff member handling ticket: </strong> TBC
                                        @endif
                                    </div>
                                    <div class="col-lg-4 border-right text-center">
                                        <strong>Issue: </strong>{{$ticket->category->name}}
                                    </div>
                                    <div class="col-lg-3 text-center" style="background-color: {{$ticket->status->color}}">
                                        <strong>Status: </strong><span>{{$ticket->status->name}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection