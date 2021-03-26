@extends('layouts.app')
@section('title', 'Ticket Display')

@section('content')
    @if (Auth::check() && Auth::user()->hasAnyRoles(['owner', 'administrator']))
        @include('tickets.show.admin')
    @elseif(Auth::check() && Auth::user()->hasAnyRoles(['moderator']))
        @if ((Auth::user()->id == $ticket->manager_id) || (Auth::user()->id == $ticket->user_id))
            @include('tickets.show.moderator')
        @else
            <script>window.location = "/abort";</script>
        @endif
    @else
        @if (Auth::user()->id !== $ticket->user_id)
            <script>window.location = "/abort";</script>   
        @else 
            @include('tickets.show.user')
        @endif    
    @endif
@endsection
@section('editor-js')
<script src="https://cdn.tiny.cloud/1/ijfbgkzbhtffss6jx1a1jcgeuxzesckga022eg6os2bg3xjl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        force_p_newlines : false,
        force_br_newlines : true,
        convert_newlines_to_brs : false,
        remove_linebreaks : true,
        forced_root_block : '', 
        selector: 'textarea#replyBody',
        plugins: 'image',
        width: "100%",
        menubar: 'file edit view format',
        toolbar: 'undo redo | bold | align',
        toolbar_mode: 'floating',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
    });
</script>
@endsection