<div class="container">
  <div class="border-frame">
      <div class="row rounded bg-light pl-3 pr-3 pt-3" id="profile-border">
          <div class="col-12">
              <div class="row">
                  <div class="col-md-4 bg-light px-1">
                      <div class="p-3 rounded h-100">
                          <img src="/storage/profile/{{$user->image}}" height="100%" width="75%" class="border border-dark rounded-circle">
                      </div>
                  </div>
                  <div class="col-md-8 bg-light pt-3">
                      <div class="row">
                          <div class="col-8">
                              <h4>{{ $user->username }}</h4><br>
                              @if ($user->hasAnyRoles(['owner', 'administrator']))
                                  <span class="admin-label px-2">Administrator</span>
                              @elseif($user->hasRole('moderator'))    
                                  <span class="mod-label px-2">Moderator</span>
                              @endif
                              <p></p>
                          </div>
                          <div class="col-4">
                              <div class="text-left float-right">
                                  @if(auth()->user() == $user)
                                      <a role="button" href="/profile/{{$user->username}}/edit">Edit Profile</a>
                                      <toggle-button :props-userid={{Auth::user()->id}} :props-current={{Auth::user()->privacy}} />
                                  @endif
                              </div>
                          </div>
                      </div>
                      {{-- <p>{{ $user->roles()->first()->name }}</p> --}}
                      <p class="text-faded">
                          Roles: 
                          @foreach($user->roles as $role)
                              <span style="font-style: italic;">{{ $role->name }}</span>
                              
                              @if(!$loop->last)
                              ,
                              @endif
                          @endforeach
                      </p>
                      <h5 style="text-decoration: underline">About Me</h5>
                      @if(isset($user->bio))
                      <p>
                          {{$user->bio}}
                      </p>
                      @elseif(Auth::user()->id == $user->id) 
                          <p>Edit profile to add a bio</p>
                      @endif
                  </div>
              </div>
              <div class="row bg-light">
                  <div class="col-12" style="border-bottom: 1px solid grey;">
                      <ul class="nav nav-tabs">
                          <li class="nav-item">
                              <a href="#posts" class="nav-link active" role="tab" data-toggle="tab">Your Posts</a>
                          </li>
                          @if (Auth::user()->hasAnyRoles(['owner', 'administrator', 'verified']))
                              <li class="nav-item">
                                  <a href="#verified" class="nav-link" role="tab" data-toggle="tab">Official Content</a>
                              </li>
                          @endif
                          <li class="nav-item">
                              <a href="#about" class="nav-link" role="tab" data-toggle="tab">About</a>
                          </li>
                      </ul>
                  </div>
              </div>

              <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade" id="about">
                      <div class="row d-flex bg-light mt-2">
                          <div class="col-6">
                              <h5 style="font-weight: bold;">Your Email: </h5>
                          </div>
                          <div class="col-6">
                              <p>{{ $user->email }}</p>
                          </div>
                      </div>
                      <div class="row d-flex bg-light mt-2">
                          <div class="col-6">
                              <h5 style="font-weight: bold;">Your Username: </h5>
                          </div>
                          <div class="col-6">
                              <p>{{ $user->username }}</p>
                          </div>
                      </div>
                      <div class="row d-flex bg-light mt-2">
                          <div class="col-6">
                              <h5 style="font-weight: bold;">Your Total Posts: </h5>
                          </div>
                          <div class="col-6">
                              <p>{{ $user->posts()->count() }}</p>
                          </div>
                      </div>
                      @if($user->can('post-verified-create'))
                          <div class="row d-flex bg-light mt-2">
                              <div class="col-6">
                                  <h5 style="font-weight: bold;">Your Total  Published Posts: </h5>
                              </div>
                              <div class="col-6">
                                  <p>{{ $user->vposts()->count() }}</p>
                              </div>
                          </div>
                      @endif
                      @if (Auth::user()->id == $user->id)
                          <div class="row d-flex bg-light mt-2">
                              <div class="col-6">
                                  <h5 style="font-weight: bold;">Want to 
                                      remove your account? </h5>
                              </div>
                              <div class="col-6">
                                  <button type="button" class="btn btn-danger" style="color:white;text-decoration: none;" data-toggle="modal" data-target="#deleteModal">
                                      Remove Account
                                  </button>
                              </div>
                          </div>
                      @endif
                  </div>
                  <div role="tabpanel" class="tab-pane fade show active" id="posts">
                      @if(count($posts) > 0)
                          <div class="row mt-3">
                              @foreach($posts as $post)
                                  <div class="col-12">
                                      <div class="row my-2">
                                          <div class="col-4 col-md-4 col-lg-1">
                                              <img class="border rounded-circle" src="/storage/posts/{{$post->image}}" alt="Post Image" height="75%" width="100%">
                                          </div>
                                          <div class="col-lg-11 col-md-8 col-8">
                                              <p class="h4 text-left float-left p-0 m-0">{{ $post->title}}</p><br><br>
                                              <p class="text-left float-left">{{ date('M dS, Y' ,strtotime($post->created_at)) }}</p>
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                          <div class="row">
                              <div class="col-lg-12 col-sm-4 d-flex justify-content-center">
                                  {{ $posts->links('vendor.pagination.simple-default') }}
                              </div>
                          </div>
                      @endif
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="verified">
                      @if(count($vposts) > 0)
                          <div class="row mt-3 mb-3">
                              @foreach($vposts as $vpost)
                                  <div class="col-12">
                                      <div class="row my-2">
                                          <div class="col-4 col-md-4 col-lg-1">
                                              <img class="border rounded-circle" src="/storage/posts/{{$vpost->image}}" alt="Post Image" height="75%" width="100%">
                                          </div>
                                          <div class="col-lg-11 col-md-8 col-8">
                                              <p class="h4 text-left float-left p-0 m-0">{{ $vpost->title}}</p><br><br>
                                              <p class="text-left float-left">{{ date('M dS, Y' ,strtotime($vpost->created_at)) }}</p>
                                          </div>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                          <div class="row">
                              <div class="col-lg-12 col-sm-4 d-flex justify-content-center">
                                  {{ $vposts->links('vendor.pagination.simple-default') }}
                              </div>
                          </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
</div>