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
            @each('tickets.tickets', $tickets, 'ticket', 'tickets.no-tickets')
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
            <h4>Assigned Staff Tickets</h4>
            @each('tickets.moderator-tickets', $moderatortickets, 'ticket', 'tickets.no-tickets')
            <hr>
            <h4>Created Tickets</h4>
            @each('tickets.user-tickets', $usertickets, 'ticket', 'tickets.no-tickets')
        @else 
            @each('tickets.user-tickets', $usertickets, 'ticket', 'tickets.no-tickets')
        @endif
    </div>
@endsection