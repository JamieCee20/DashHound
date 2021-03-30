<div class="container">
    <div class="row my-3  p-2" id="postBox">
        <div class="col-6">
            <img class="mx-auto" src="/storage/posts/{{ $vpost->image }}" height="100%" width="100%"
                alt="Published Image">
        </div>
        <div class="col-6 text-left">
            <p class="h2"><a href="/v/{{ $vpost->id }}" style="color: red; text-decoration: none;">{{ $vpost->title }}</a></p><br>
            <p class="text-muted font-italic">Published by: {{ $vpost->user->name }} | {{ date('F dS, Y - g:iA', strtotime($vpost->created_at)) }}</p><br>
            <p class="text-muted font-italic"><strong>Total Likes: </strong>{{ $vpost->likes()->count() }}</p>
        </div>
    </div>
</div>
