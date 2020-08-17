<?php

namespace App\Http\Controllers;

use App\Like;
use App\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    //Function to toggle whether post is liked or disliked
    public function toggleLike(Verified $verified, Like $like) {
        $post_id = $verified->id;
        $user_id = Auth::user()->id;
        $liked = 1;

        $alreadyLiked = Like::where('user_id', $user_id)->get();

        if ($alreadyLiked->isEmpty()) {

            auth()->user()->likes()->create([
                'user_id' => $user_id,
                'verifieds_id' => $post_id,
                'is_liked' => $liked,
            ]);

            return redirect()->route('verifieds.show', ['verified' => $verified->id]);
        } else {
            Like::where('user_id', $user_id)->delete();

            return redirect()->route('verifieds.show', ['verified' => $verified->id]);
        }
    }
}
