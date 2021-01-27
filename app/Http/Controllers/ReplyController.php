<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Discussion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $postId = Discussion::find($id);
        $userId = Auth::user()->id;

        if(isset($request->reply_user)) {
            $comment_owner = $request->reply_user;
        }

        if(isset($request->reply_id)) {
            $comment_id = $request->reply_id;
        }

        $this->validate($request, array(
            'body' => 'required|min:5'
        ));

        $input = $request->body;
        $cleaned = clean($input);
        
        $reply = new Reply();

        if(isset($comment_owner) || isset($comment_id)) {
            $reply->reply_owner_name = $comment_owner;
            $reply->reply_owner_id = $comment_id;
        }

        $reply->body = $input;
        $reply->discussion()->associate($postId);
        $reply->user()->associate($userId);
        $reply->save();

        $request->session()->flash('success', 'Reply submitted!');


        return redirect()->route('forum.show', [$postId]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
        $this->authorize('update', $reply);

        return view('replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        $postId = $reply->discussion->slug;

        $data = request()->validate([
            'body' => 'required|min:5',
        ]);

        if($reply->user_id == Auth::user()->id) {
            $cleaned = clean($data);
    
            $reply->update($cleaned);
    
            $request->session()->flash('success', 'Reply updated!');
    
            return redirect()->route('forum.show', [$postId]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Security check to make sure the attempted deletion comment belongs to current logged in user. References in Policy
        $reply_id = Reply::find($id);
        $this->authorize('delete', $reply_id);

        $replyPost = Reply::find($id);
        $replyPost->delete();

        return redirect('/forums/'.$replyPost->discussion->slug)->with('success', 'Reply Removed');
    }
}
