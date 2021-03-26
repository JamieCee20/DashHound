<div class="post-rows text-white">
  <div class="row shadow-sm" style="height:60%;" id="postBox">
      <div class=" d-none d-sm-none d-md-block col-md-2 col-lg-1 col-xl-1 py-2">
          <img class="rounded-circle" src="/storage/posts/{{$post->image}}" alt="post image" height="90%;" width="100%;">
      </div>
      @if($post->spoilers == 1)
          <div class="col-8 col-sm-8 col-md-5 col-lg-5 col-xl-5">
              <p class="ml-2 overflow-wrap" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->slug }}">{{ $post->title }}</a></p>
              <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->username }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
          </div>
          <div class="col-2">
              <p class="text-center py-3" style="margin:auto;width:100%;">
                  This post may contain <strong style="color:#B6B8D6;">Spoilers</strong>
              </p>
          </div>
      @elseif($post->spoilers == 0)
          <div class="col-7">
              <p class="ml-2 overflow-wrap" style="min-width:100%;letter-spacing:2px;font-size:18px;"><a href="/p/{{ $post->slug }}">{{ $post->title }}</a></p>
              <p style="font-size:12px;" class="text-muted font-italic ml-2">{{ $post->user->username }} &middot; {{ date('MdS, Y' ,strtotime($post->created_at)) }}</p>
          </div>
      @endif
      <div class="d-none d-sm-none d-md-block col-md-2 col-lg-2 col-xl-2">
          <p class="justify-content-center"><span class="text-muted">Comments:</span> {{$post->comments()->count()}}</p>
          @if($post->views == 0)
              <p class="justify-content-center">Views: 0</p>
          @else
              <p class="justify-content-center"><span class="text-muted">Views:</span> {{ $post->views }}</p>
          @endif
      </div>
      <div class="d-none d-sm-none d-md-block col-md-2 col-lg-2 col-xl-2">
          @if($post->comments->isEmpty())
              <p class="font-italic" style="opacity:0.6;font-size:14px;">No comments.</p>
          @else
              <p class="font-italic" style="opacity:0.6;font-size:14px;">{{ date('MdS, g:iA' ,strtotime($post->comments->first()->created_at)) }} | {{ $post->comments->first()->name }}</p>
          @endif
      </div>
  </div>
</div>