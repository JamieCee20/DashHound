<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Role;
use App\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

class ProfilesController extends Controller
{

/**
 * |----------------------
 * | Profiles Constructor
 * |----------------------
 * |
 * |
 */
// public function __construct() {
//     $this->middleware('auth');
// }

/**
 * |------------------------------------
 * | Index for the profile controller
 * |------------------------------------
 * | Index holds the information needed to display all of the users posts.
 * |
 */
    public function index(User $user)
    {
        //
        $posts = Post::where('user_id', $user->id)->latest()->paginate(6);
        $vposts = Verified::where('user_id', $user->id)->latest()->paginate(6);
        return view('profiles.index', compact('user', 'posts', 'vposts'));
    }

/**
 * |-------------------------
 * | Edit current profile
 * |-------------------------
 * | Checks to make sure the user editing the profile is only editing their own profile.
 * |
 */
    public function edit(User $user)
    {
        // $this->authorize('update', $user->profile);
        $logged_in = Auth::user()->id;
        if($user->id == $logged_in) {
            return view('profiles.edit', compact('user'));
        } else {
            return redirect("/profile/{$logged_in}")->with('error', 'You can only edit your own profile');
        }
    }

/**
 * |------------------------
 * | Update current profile
 * |------------------------
 * | Send updated information to database with an extra validation to ensure self user updating.
 * |
 */
    public function update(Request $request, User $user)
    {
        $logged_in = Auth::user()->id;
        if($user->id == $logged_in) {

            $data = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'username' => 'required|string|max:255',
                'bio' => 'max:1000',
                'image' => 'image',
            ]);

            // dd($request->file('image'));
            
            if($request->file('image')) {
                $file = $request->file('image');
                $string = Str::random(25);
                $name = $string.'.'.$file->getClientOriginalExtension();

                $dest = public_path('storage/profile/');
                $file->move($dest, $name);
                $input = $request->all();
                $input['image'] = $name;

                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'image' => $name,
                    'bio' => $data['bio'],
                ]);
            } else {
                $user->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'bio' => $data['bio'],
                ]);
            }
    
            return redirect("/profile/{$user->id}")->with('success', 'Profile successfully updated');
        }
    }
}
