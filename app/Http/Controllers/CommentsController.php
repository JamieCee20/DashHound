<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{

/**
 * |-----------------------------
 * | Constructor to check for auth user
 * |-----------------------------
 * |
 * |
 */
    public function __construct()
    {
        $this->middleware('auth');
    }

/**
 * |-----------------------------
 * | Store the new comment
 * |-----------------------------
 * |
 * |
 */
    public function store(Request $request, $id)
    {
        $postId = Post::find($id);
        $userId = Auth::user()->id;
        $name = Auth::user()->name;

        $this->validate($request, array(
            'comment' => 'required|min:5|max:2000'
        ));
        $comment = new Comment();

        $comment->name = $name;
        $comment->comment = $request->comment;
        $comment->approved = true;
        $comment->post()->associate($postId);
        $comment->user()->associate($userId);
        $comment->save();

        $request->session()->flash('success', 'Your comment has been added');


        return redirect()->route('post.show', [$postId]);
    }

/**
 * |-----------------------------
 * | Edit selected comment
 * |-----------------------------
 * |
 * |
 */
    public function edit(Comment $comment)
    {
        //
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

/**
 * |-----------------------------
 * | Update selected comment
 * |-----------------------------
 * |
 * |
 */
    public function update(Request $request, Comment $comment)
    {
        //
        $this->authorize('update', $comment);

        $data = request()->validate([
            'comment' => 'required|min:5|max:255|',
        ]);

        $comment->update($data);
        
        return redirect('/p/'.$comment->user->post->title)->with('success', 'Comment Edited');

    }

/**
 * |-----------------------------
 * | Delete selected comment
 * |-----------------------------
 * |
 * |
 */
    public function destroy(Comment $comment)
    {
        //Security check to make sure the attempted deletion comment belongs to current logged in user. References in Policy
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect('/p/'.$comment->post->title)->with('success', 'Comment Removed');
    }
}
