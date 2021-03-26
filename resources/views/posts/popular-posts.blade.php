<div class="row shadow-sm mb-5 page-display" style="height:60%;" id="postBox">
  <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 pr-4 mx-auto">
      <div class="img">
          <img src="/storage/posts/{{$popular->image}}" alt="profile image" class="rounded post-index-image" height="90%;" width="100%;">
          <div class="overlay-color centered">
              @if($popular->views == 0)
                  <p class="justify-content-center">Views: 0</p>
              @else
                  <p class="justify-content-center"><span class="text-image">Views:</span> {{ $popular->views }}</p>
              @endif
          </div>
      </div>
  </div>
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 border-left post-links">
      @if($popular->spoilers == 1)
              <h2 class="overflow-wrap" style="min-width:100%;letter-spacing:2px;"><a href="/p/{{ $popular->slug }}">{{ $popular->title }}</a></h2>
              <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $popular->user->username }} &middot; {{ date('MdS, Y' ,strtotime($popular->created_at)) }}</p>
              <p class="text-center py-3 text-white" style="margin:auto;width:100%;">
                  &diams; This post may contain <strong>Spoilers</strong> &diams;
              </p>
      @elseif($popular->spoilers == 0)
              <h2 class="overflow-wrap" style="min-width:100%;letter-spacing:2px;"><a href="/p/{{ $popular->slug }}">{{ $popular->title }}</a></h2>
              <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $popular->user->username }} &middot; {{ date('MdS, Y' ,strtotime($popular->created_at)) }}</p>
      @endif
      @if(strlen($popular->description) > 200)
          <p class="text-white comment more">
              {{substr($popular->description, 0, 200)}}...
          </p>
          <a role="button" class="btn btn-outline-light" href="{{ route("post.show", $popular->title) }}">Read More</a>
      @else
      <p class="text-white">
          {{$popular->description}}
      </p>
      @endif
  </div>
  <div class="d-none d-sm-none d-md-block col-md-2 text-white my-auto">
      <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$popular->comments()->count()}}</p>
      <div class="my-3">
          @if($popular->comments->isEmpty())
              <p class="font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
          @else
              <p class="font-italic" style="opacity:0.6;font-size:14px;">{{ date('M dS, g:iA' ,strtotime($popular->comments->first()->created_at)) }} | {{ $popular->comments->first()->name }}</p>
          @endif
      </div>
  </div>
</div>