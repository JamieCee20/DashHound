@extends('layouts.app')
@section('title', 'Edit Profile')

@section('extra-css')
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
@endsection

@section('content')
    @if (Auth::check() && Auth::user()->hasAnyRoles(['owner', 'administrator', 'moderator']))
        @include('profiles.show.staff')
    @else
        @if ($user->privacy == 1)
            @if (Auth::check() && Auth::user()->id == $user->id)
                @include('profiles.show.user')
            @else
                <script>window.location = "/private";</script>
            @endif
        @else
            @include('profiles.show.no-auth-user')
        @endif
    @endif
    
    <!-- Edit Profile Modal -->
    <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog" aria-labelledby="profileEditModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileEditModalLabel">Edit Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('profiles.edit')
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Profile Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure you want to delete your account?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center font-italic" style="color:#c2c4c2;">Note: This action can't be undone.</p>
                    @include('profiles.deleteModal')
                </div>
            </div>
        </div>
    </div>
@endsection

