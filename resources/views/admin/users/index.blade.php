@extends('layouts.app')
@section('title', 'User Management')

@section('content')
  <div class="row">
    <div class="col-12 col-md-12">

      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a href="#user-management"
            class="nav-link active"
            role="tab"
            data-toggle="tab">User Management</a>
        </li>
        <li class="nav-item">
          <a href="#forum-management"
            class="nav-link"
            role="tab"
            data-toggle="tab">Forum Discussions</a>
        </li>
        <li class="nav-item">
          <a href="#pinned-management"
            class="nav-link"
            role="tab"
            data-toggle="tab">Pinned Discussions</a>
        </li>
        <li class="nav-item">
          <a href="/admin/users"
            class="nav-link">Reset Search</a>
        </li>
      </ul>


      <div class="tab-content text-white">
        <div role="tabpanel"
          class="tab-pane fade show active"
          id="user-management">
          @if (Auth::user()->hasRole('owner'))
            <div class="card">
              <div class="card-header text-secondary">
              </div>

              <div class="user-management-content">
                <div class="card-body text-dark">

                  <div class="row justify-content-center pb-3">
                    <div class="col-md-8">
                      <form action="/usersearch"
                        method="POST"
                        role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                          <input type="text"
                            class="form-control"
                            name="qUser"
                            placeholder="Search users"><span class="input-group-btn">
                            <button type="submit"
                              class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="mt-5">
                    @if (isset($details))
                      <p> All users matching <b> '{{ $query }}' </b> are :</p>
                      <div class="row">
                        <div class="col-12">
                          <div class="row bg-dark text-white">
                            <div class="col-1">
                              #
                            </div>
                            <div class="col-3 col-md-2">
                              Username
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              Email
                            </div>
                            <div class="col-3 col-md-2">
                              Roles
                            </div>
                            <div class="col-3 col-md-3">
                              Actions
                            </div>
                          </div>
                          @foreach ($details as $qUser)
                            <div class="row my-2 dashboardRow">
                              <div class="col-1">
                                {{ $qUser->id }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ $qUser->username }}
                              </div>
                              <div class="d-none d-sm-none d-md-block col-md-4">
                                {{ $qUser->email }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ implode(
    ', ',
    $qUser->roles()->get()->pluck('name')->toArray(),
) }}
                              </div>
                              <div class="col-3 col-md-3">
                                <div class="row">
                                  <div class="col-12">
                                    @can('edit-users')
                                      <a data-toggle="tooltip"
                                        data-html="true"
                                        data-html="true"
                                        title="Edit this user"
                                        href="{{ route('admin.users.edit', $qUser->username) }}"><button type="button"
                                          class="btn btn-primary btnSize my-1">Edit</button></a>
                                    @endcan
                                  </div>
                                  <div class="col-12">
                                    @can('delete-users')
                                      <form action="{{ route('admin.users.destroy', $qUser) }}"
                                        method="POST"
                                        class="">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="Remove this user"
                                          type="submit"
                                          class="btn btn-danger btnSize my-1">&times;</button>
                                      </form>
                                    @endcan
                                  </div>
                                  <div class="col-12">
                                    @can('manage-users')
                                      @if ($qUser->banned_until != null)
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="User is already suspended"
                                          href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                            class="btn btn-danger btnSize my-1"
                                            disabled><i class="fas fa-ban"></i></button></a>
                                      @else
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="Suspend this user"
                                          href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                            class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                      @endif
                                    @endcan
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>

                  @if (!isset($details))
                    <div class="row">
                      <div class="col-12">
                        <div class="row bg-dark text-white">
                          <div class="col-1">
                            #
                          </div>
                          <div class="col-3 col-md-2">
                            Username
                          </div>
                          <div class="d-none d-sm-none d-md-block col-md-4">
                            Email
                          </div>
                          <div class="col-3 col-md-2">
                            Roles
                          </div>
                          <div class="col-3 col-md-3">
                            Actions
                          </div>
                        </div>
                        @foreach ($users as $user)
                          <div class="row my-2">
                            <div class="col-1">
                              {{ $user->id }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ $user->username }}
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              {{ $user->email }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ implode(
    ', ',
    $user->roles()->get()->pluck('name')->toArray(),
) }}
                            </div>
                            <div class="col-3 col-md-3">
                              <div class="row">
                                <div class="col-12">
                                  @can('edit-users')
                                    <a data-toggle="tooltip"
                                      data-html="true"
                                      data-html="true"
                                      title="Edit this user"
                                      href="{{ route('admin.users.edit', $user->username) }}"><button type="button"
                                        class="btn btn-primary btnSize my-1">Edit</button></a>
                                  @endcan
                                </div>
                                <div class="col-12">
                                  @can('delete-users')
                                    {!! Form::open(['method' => 'POST', 'route' => ['admin.users.destroy', $user]]) !!}
                                      {{ Form::hidden('_method', 'DELETE') }}
                                      {{Form::submit('&times;', ['class' => 'btn btn-danger btnSize my-1', 'data-toggle' => 'tooltip', 'data-html' => 'true', 'title' => 'Remove this user'])}}
                                    {!! Form::close() !!}
                                  @endcan
                                </div>
                                <div class="col-12">
                                  @can('manage-users')
                                    @if ($user->banned_until != null)
                                      <a data-toggle="tooltip"
                                        data-html="true"
                                        data-html="true"
                                        title="User is already suspended"
                                        href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                          class="btn btn-danger btnSize my-1"
                                          disabled><i class="fas fa-ban"></i></button></a>
                                    @else
                                      <a data-toggle="tooltip"
                                        data-html="true"
                                        data-html="true"
                                        title="Suspend this user"
                                        href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                          class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                    @endif
                                  @endcan
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                  <div class="d-flex justify-content-center">
                    {{ $users->appends(['forums' => $forums->currentPage(), 'pinned' => $pinned->currentPage()])->links() }}
                  </div>
                </div>
              </div>
            </div>
          @elseif(Auth::user()->hasRole('administrator'))
            <div class="card">
              <div class="card-header text-secondary">
              </div>

              <div class="user-management-content">
                <div class="card-body text-dark">

                  <div class="row justify-content-center pb-3">
                    <div class="col-md-8">
                      <form action="/usersearch"
                        method="POST"
                        role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                          <input type="text"
                            class="form-control"
                            name="qUser"
                            placeholder="Search users"><span class="input-group-btn">
                            <button type="submit"
                              class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="mt-5">
                    @if (isset($details))
                      <p> All users matching <b> '{{ $query }}' </b> are :</p>
                      <div class="row">
                        <div class="col-12">
                          <div class="row bg-dark text-white">
                            <div class="col-1">
                              #
                            </div>
                            <div class="col-3 col-md-2">
                              Username
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              Email
                            </div>
                            <div class="col-3 col-md-2">
                              Roles
                            </div>
                            <div class="col-3 col-md-3">
                              Actions
                            </div>
                          </div>
                          @foreach ($details as $qUser)
                            <div class="row my-2">
                              <div class="col-1">
                                {{ $qUser->id }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ $qUser->username }}
                              </div>
                              <div class="d-none d-sm-none d-md-block col-md-4">
                                {{ $qUser->email }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ implode(
    ', ',
    $qUser->roles()->get()->pluck('name')->toArray(),
) }}
                              </div>
                              <div class="col-3 col-md-3">
                                <div class="row">
                                  <div class="col-12">
                                    @can('edit-users')
                                      <a data-toggle="tooltip"
                                        data-html="true"
                                        data-html="true"
                                        title="Edit this user"
                                        href="{{ route('admin.users.edit', $qUser->username) }}"><button type="button"
                                          class="btn btn-primary btnSize my-1">Edit</button></a>
                                    @endcan
                                  </div>
                                  <div class="col-12">
                                    @can('delete-users')
                                      @if (!$qUser->hasAnyRoles(['owner', 'administrator']))
                                        {!! Form::open(['method' => 'POST', 'route' => ['admin.users.destroy', $qUser], 'onsubmit' => 'ConfirmDelete()']) !!}
                                          {{ Form::hidden('_method', 'DELETE') }}
                                          {{Form::submit('&times;', ['class' => 'btn btn-danger btnSize my-1', 'data-toggle' => 'tooltip', 'data-html' => 'true', 'title' => 'Remove this user'])}}
                                        {!! Form::close() !!}
                                      @endif
                                    @endcan
                                  </div>
                                  <div class="col-12">
                                    @can('manage-users')
                                      @if (!$qUser->hasAnyRoles(['owner', 'administrator']))
                                        @if ($qUser->banned_until != null)
                                          <a data-toggle="tooltip"
                                            data-html="true"
                                            data-html="true"
                                            title="User is already suspended"
                                            href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                              class="btn btn-danger btnSize my-1"
                                              disabled><i class="fas fa-ban"></i></button></a>
                                        @else
                                          <a data-toggle="tooltip"
                                            data-html="true"
                                            data-html="true"
                                            title="Suspend this user"
                                            href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                              class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                        @endif
                                      @endif
                                    @endcan
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>

                  @if (!isset($details))
                    <div class="row">
                      <div class="col-12">
                        <div class="row bg-dark text-white">
                          <div class="col-1">
                            #
                          </div>
                          <div class="col-3 col-md-2">
                            Username
                          </div>
                          <div class="d-none d-sm-none d-md-block col-md-4">
                            Email
                          </div>
                          <div class="col-3 col-md-2">
                            Roles
                          </div>
                          <div class="col-3 col-md-3">
                            Actions
                          </div>
                        </div>
                        @foreach ($users as $user)
                          <div class="row my-2">
                            <div class="col-1">
                              {{ $user->id }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ $user->username }}
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              {{ $user->email }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ implode(
    ', ',
    $user->roles()->get()->pluck('name')->toArray(),
) }}
                            </div>
                            <div class="col-3 col-md-3">
                              <div class="row">
                                <div class="col-12">
                                  @can('edit-users')
                                    <a data-toggle="tooltip"
                                      data-html="true"
                                      data-html="true"
                                      title="Edit this user"
                                      href="{{ route('admin.users.edit', $user->username) }}"><button type="button"
                                        class="btn btn-primary btnSize my-1">Edit</button></a>
                                  @endcan
                                </div>
                                <div class="col-12">
                                  @can('delete-users')
                                    @if (!$user->hasAnyRoles(['owner', 'administrator']))
                                      {!! Form::open(['method' => 'POST', 'route' => ['admin.users.destroy', $user], 'onsubmit' => 'ConfirmDelete()']) !!}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{Form::submit('&times;', ['class' => 'btn btn-danger btnSize my-1', 'data-toggle' => 'tooltip', 'data-html' => 'true', 'title' => 'Remove this user'])}}
                                      {!! Form::close() !!}
                                    @endif
                                  @endcan
                                </div>
                                <div class="col-12">
                                  @can('manage-users')
                                    @if (!$user->hasAnyRoles(['owner', 'administrator']))
                                      @if ($user->banned_until != null)
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="User is already suspended"
                                          href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                            class="btn btn-danger btnSize my-1"
                                            disabled><i class="fas fa-ban"></i></button></a>
                                      @else
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="Suspend this user"
                                          href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                            class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                      @endif
                                    @endif
                                  @endcan
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                  <div class="d-flex justify-content-center">
                    {{ $users->appends(['forums' => $forums->currentPage(), 'pinned' => $pinned->currentPage()])->links() }}
                  </div>
                </div>
              </div>
            </div>
          @elseif(Auth::user()->hasRole('moderator'))
            <div class="card">
              <div class="card-header text-secondary">
              </div>

              <div class="user-management-content">
                <div class="card-body text-dark">

                  <div class="row justify-content-center pb-3">
                    <div class="col-md-8">
                      <form action="/usersearch"
                        method="POST"
                        role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                          <input type="text"
                            class="form-control"
                            name="qUser"
                            placeholder="Search users"><span class="input-group-btn">
                            <button type="submit"
                              class="btn btn-default">
                              <i class="fas fa-search"></i>
                            </button>
                          </span>
                        </div>
                      </form>
                    </div>
                  </div>

                  <div class="mt-5">
                    @if (isset($details))
                      <p> All users matching <b> '{{ $query }}' </b> are :</p>
                      <div class="row">
                        <div class="col-12">
                          <div class="row bg-dark text-white">
                            <div class="col-1">
                              #
                            </div>
                            <div class="col-3 col-md-2">
                              Name
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              Email
                            </div>
                            <div class="col-3 col-md-2">
                              Roles
                            </div>
                            <div class="col-3 col-md-3">
                              Actions
                            </div>
                          </div>
                          @foreach ($details as $qUser)
                            <div class="row my-2">
                              <div class="col-1">
                                {{ $qUser->id }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ $qUser->name }}
                              </div>
                              <div class="d-none d-sm-none d-md-block col-md-4">
                                {{ $qUser->email }}
                              </div>
                              <div class="col-3 col-md-2">
                                {{ implode(
    ', ',
    $qUser->roles()->get()->pluck('name')->toArray(),
) }}
                              </div>
                              <div class="col-3 col-md-3">
                                <div class="row">
                                  <div class="col-12">
                                    @can('edit-users')
                                      <a data-toggle="tooltip"
                                        data-html="true"
                                        data-html="true"
                                        title="Edit this user"
                                        href="{{ route('admin.users.edit', $qUser->username) }}"><button type="button"
                                          class="btn btn-primary btnSize my-1">Edit</button></a>
                                    @endcan
                                  </div>
                                  {{-- <div class="col-12">
                                    @can('delete-users')
                                      @if (!$qUser->hasAnyRoles(['owner', 'administrator', 'moderator']))
                                        {!! Form::open(['method' => 'POST', 'route' => ['admin.users.destroy', $qUser], 'onsubmit' => 'ConfirmDelete()']) !!}
                                          {{ Form::hidden('_method', 'DELETE') }}
                                          {{Form::submit('&times;', ['class' => 'btn btn-danger btnSize my-1', 'data-toggle' => 'tooltip', 'data-html' => 'true', 'title' => 'Remove this user'])}}
                                        {!! Form::close() !!}
                                      @endif
                                    @endcan
                                  </div> --}}
                                  <div class="col-12">
                                    @can('manage-users')
                                      @if (!$qUser->hasAnyRoles(['owner', 'administrator', 'moderator']))
                                        @if ($qUser->banned_until != null)
                                          <a data-toggle="tooltip"
                                            data-html="true"
                                            data-html="true"
                                            title="User is already suspended"
                                            href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                              class="btn btn-danger btnSize my-1"
                                              disabled><i class="fas fa-ban"></i></button></a>
                                        @else
                                          <a data-toggle="tooltip"
                                            data-html="true"
                                            data-html="true"
                                            title="Suspend this user"
                                            href="{{ route('admin.user.suspend', $qUser) }}"><button type="button"
                                              class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                        @endif
                                      @endif
                                    @endcan
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif
                  </div>

                  @if (!isset($details))
                    <div class="row">
                      <div class="col-12">
                        <div class="row bg-dark text-white">
                          <div class="col-1">
                            #
                          </div>
                          <div class="col-3 col-md-2">
                            Name
                          </div>
                          <div class="d-none d-sm-none d-md-block col-md-4">
                            Email
                          </div>
                          <div class="col-3 col-md-2">
                            Roles
                          </div>
                          <div class="col-3 col-md-3">
                            Actions
                          </div>
                        </div>
                        @foreach ($users as $user)
                          <div class="row my-2">
                            <div class="col-1">
                              {{ $user->id }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ $user->name }}
                            </div>
                            <div class="d-none d-sm-none d-md-block col-md-4">
                              {{ $user->email }}
                            </div>
                            <div class="col-3 col-md-2">
                              {{ implode(
    ', ',
    $user->roles()->get()->pluck('name')->toArray(),
) }}
                            </div>
                            <div class="col-3 col-md-3">
                              <div class="row">
                                <div class="col-12">
                                  @can('edit-users')
                                    <a data-toggle="tooltip"
                                      data-html="true"
                                      data-html="true"
                                      title="Edit this user"
                                      href="{{ route('admin.users.edit', $user) }}"><button type="button"
                                        class="btn btn-primary btnSize my-1">Edit</button></a>
                                  @endcan
                                </div>
                                <div class="col-12">
                                   @can('delete-users')
                                    @if (!$user->hasAnyRoles(['owner', 'administrator', 'moderator']))
                                      {!! Form::open(['method' => 'POST', 'route' => ['admin.users.destroy', $user->username], 'onsubmit' => 'ConfirmDelete()']) !!}
                                        {{ Form::hidden('_method', 'DELETE') }}
                                        {{Form::submit('&times;', ['class' => 'btn btn-danger btnSize my-1', 'data-toggle' => 'tooltip', 'data-html' => 'true', 'title' => 'Remove this user'])}}
                                      {!! Form::close() !!}
                                    @endif
                                  @endcan
                                </div>
                                <div class="col-12">
                                  @can('manage-users')
                                    @if (!$user->hasAnyRoles(['owner', 'administrator', 'moderator']))
                                      @if ($user->banned_until != null)
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="User is already suspended"
                                          href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                            class="btn btn-danger btnSize my-1"
                                            disabled><i class="fas fa-ban"></i></button></a>
                                      @else
                                        <a data-toggle="tooltip"
                                          data-html="true"
                                          data-html="true"
                                          title="Suspend this user"
                                          href="{{ route('admin.user.suspend', $user) }}"><button type="button"
                                            class="btn btn-warning btnSize my-1"><i class="fas fa-ban"></i></button></a>
                                      @endif
                                    @endif
                                  @endcan
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  @endif
                  <div class="d-flex justify-content-center">
                    {{ $users->appends(['forums' => $forums->currentPage(), 'pinned' => $pinned->currentPage()])->links() }}
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
        <div role="tabpanel"
          class="tab-pane fade"
          id="forum-management">
          <div class="card">
            <div class="card-header text-secondary">
              Forum Posts
            </div>

            <div class="user-management-content">
              <div class="card-body text-dark">
                <div class="row justify-content-center pb-3">
                  <div class="col-md-8">
                    <ul class="list-group list-group-flush text-center">
                      @foreach ($forums as $discussion)
                        <li class="list-group-item forum-list">
                          <a href="/forums/{{ $discussion->slug }}">{{ $discussion->title }}</a>
                          <span class="rounded m-1"
                            style="background-color: {{ $discussion->category->color }};font-weight:bold;color:white;text-shadow:1px 1px 1px black;">
                            <span class="p-2">
                              {{ $discussion->category->name }}
                            </span>
                          </span>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="row justify-content-center pb-3">
                  {{ $forums->appends(['users' => $users->currentPage(), 'pinned' => $pinned->currentPage()])->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
        <div role="tabpanel"
          class="tab-pane fade"
          id="pinned-management">
          <div class="card">
            <div class="card-header text-secondary">
              Pinned Forum Posts
            </div>

            <div class="user-management-content">
              <div class="card-body text-dark">
                <div class="row justify-content-center pb-3">
                  <div class="col-md-8">
                    <ul class="list-group list-group-flush text-center">
                      @foreach ($pinned as $pin)
                        <li class="list-group-item list-group-item-info forum-list my-2">
                          <a href="/forums/{{ $pin->slug }}">{{ $pin->title }}</a>
                          <span class="rounded m-1"
                            style="background-color: {{ $pin->category->color }};font-weight:bold;color:white;text-shadow:1px 1px 1px black;">
                            <span class="p-2">
                              {{ $pin->category->name }}
                            </span>
                          </span>
                        </li>
                      @endforeach
                    </ul>
                  </div>
                </div>
                <div class="row justify-content-center pb-3">
                  {{ $pinned->appends(['users' => $users->currentPage(), 'forums' => $forums->currentPage()])->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
@endsection

@section('editor-js')
  {{-- <script>
    function ConfirmDelete() {
      return confirm('Are you sure you want to delete this user?');
    }

  </script> --}}
@endsection
