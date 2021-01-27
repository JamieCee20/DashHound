<?php

namespace App\Http\Controllers;

use App\Reply;
use App\Category;
use App\Discussion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Stevebauman\Purify\Facades\Purify;

class DiscussionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pagination = 20;
        $categories = Category::all();

        if(request()->category) { //If there is a category request

            // Post with related category query
            $discussions = Discussion::with('category')->whereHas('category', function($query) {
                $query->where('slug', request()->category);
            })->paginate($pagination);

            // Pinned posts found within category query
            $pinned = Discussion::with('category')->whereHas('category', function($query) {
                $query->where('slug', request()->category)->where('pinned', '1');
            })->take(3)->get(); 

            // Category query as a value
            $categoryName = optional($categories->where('slug', request()->category)->first())->name;

            return view('forums.index', compact('discussions', 'categories', 'categoryName', 'pinned'));
        } else {
            $discussions = Discussion::latest()->paginate($pagination);
            $categoryName = 'All Discussions';

            return view('forums.index', compact('discussions', 'categories', 'categoryName'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id');
        return view('forums.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255|string',
            'body' => 'required|string',
            'pinned' => '',
            'category' => 'required',
        ]);

        if($request->pinned == "true") {
            $pinned = '1';
        } else {
            $pinned = '0';
        }

        if($request->category == 2) {
            if(Auth::user()->hasAnyRoles(['owner', 'administrator', 'moderator'])) {
                $slug = Str::slug($request->title, '-');

                $input = $request->body;
                $cleaned = Purify::clean($input);
        
                $current = Discussion::where('title', $request->title)->first();
        
                if($current) {
                    return redirect('/forums')->with('error', 'Discussion Title already exists');
                } else {
                    $discussion = auth()->user()->discussions()->make([
                        'title' => $data['title'],
                        'slug' => $slug,
                        'pinned' => $pinned,
                        'body' => $cleaned,
                        'image' => null,
                    ]);
                    $discussion->category()->associate($request->category)->save();
                    return redirect('/forums')->with('success', 'Discussion successfully created!');
                }
            } else {
                return redirect('/forums')->with('error', 'You do not have permission to post in this category!');
            }
        } else {
            $slug = Str::slug($request->title, '-');

            $input = $request->body;
            $cleaned = Purify::clean($input);
    
            $current = Discussion::where('title', $request->title)->first();
    
            if($current) {
                return redirect('/forums')->with('error', 'Discussion Title already exists');
            } else {
                $discussion = auth()->user()->discussions()->make([
                    'title' => $data['title'],
                    'slug' => $slug,
                    'pinned' => $pinned,
                    'body' => $cleaned,
                    'image' => null,
                ]);
                $discussion->category()->associate($request->category)->save();
                return redirect('/forums')->with('success', 'Discussion successfully created!');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function show(Discussion $discussion)
    {
        $replies = $discussion->replies()->orderBy('created_at', 'ASC')->paginate(30);

        return view('forums.show', compact('discussion', 'replies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function edit(Discussion $discussion)
    {
        //
        $this->authorize('update', $discussion);

        return view('forums.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discussion $discussion)
    {
        //
        $this->authorize('update', $discussion);

        $data = request()->validate([
            'title' => 'required|max:255|',
            'body' => 'required',
        ]);

        $discussion->update([
            'title' => $data['title'],
            'body' => $data['body'],
            'updated_at' => Carbon::now()
        ]);

        return redirect('/forums')->with('success', 'Discussion Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discussion  $discussion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Destroy function to remove discussion
        $post = Discussion::find($id);
        $this->authorize('delete', $post);

        $posts = Discussion::find($id)->delete();

        return redirect('/forums')->with('success', 'Successfully removed discussion');
    }

    /**
     * Display content to an admin dashboard to view all posts, categorised by pinned and all
     * 
     * 
     */
    public function admin() {
        return "Admin Dashboard";
    }
}
