@extends('layouts.app')
@section('title', 'Verified Publishers')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (auth()->user()->hasAnyRoles(['owner', 'admin', 'moderator', 'verified']))
                <a class="btn btn-outline-light float-right" href="{{ route('vpost.create') }}">Create Post</a>
                @endif
            </div>
        </div>
    </div>
    @each('verifieds.vposts', $vposts, 'vpost', 'verifieds.no-vposts')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $vposts->links() }}
            </div>
        </div>
    </div>
@endsection