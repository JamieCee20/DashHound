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
        $post_id = $verified->id; // Call the post ID and save as a variable
        $user_id = Auth::user()->id; // Provide the ID of the logged in user and save as a variable
        $liked = 1; // Rendering pointless currently

        $alreadyLiked = Like::where('user_id', $user_id)->where('verified_id', $post_id)->get();

        if ($alreadyLiked->isEmpty()) {

            auth()->user()->likes()->create([
                'user_id' => $user_id,
                'verified_id' => $post_id,
                'is_liked' => $liked,
            ]);

            return redirect()->route('verifieds.show', ['verified' => $verified->id]);
        } else {
            Like::where('user_id', $user_id)->where('verified_id', $post_id)->delete();

            return redirect()->route('verifieds.show', ['verified' => $verified->id]);
        }
    }
}
