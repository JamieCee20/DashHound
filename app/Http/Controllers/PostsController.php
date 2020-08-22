<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as Image;

class PostsController extends Controller
{
    /**
     * |---------------------------------------------------------------------
     * |    the construct function makes sure that the user is authorized
     * |---------------------------------------------------------------------
     * |
     * |
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * |--------------------------------------------------------------
     * |    Index is the home control of the post section
     * |--------------------------------------------------------------
     * |
     * |
     */
    public function index()
    {
        //
        // $posts = Post::where('id', '>', 0)->orderBy('id', 'DESC')->paginate(15);
        $posts = Post::latest()->with([
            'comments' => function ($query) {
                return $query->latest();
            },
        ])->paginate();
        $popular_posts = Post::orderBy('views', 'DESC')->take(3)->get();
        $views = Post::all('views');
        return view('posts.index', compact('posts', 'views', 'popular_posts'));

    }

    /**
     * |--------------------------------------------------------------
     * |    Create function will display the create a post form
     * |--------------------------------------------------------------
     * |
     * |
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * |-----------------------------------------------------------|
     * |    Store the data from create post form into the database |
     * |-----------------------------------------------------------|
     * |
     * |
     */

    public function store(Request $request)
    {
        
        $data = $request->validate([
            'title' => 'required|max:255|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        $file = $request->file('image');
        $name = $file->getClientOriginalName();

        $image_resize = Image::make($file->getRealPath());
        $image_resize->resize(1200, 1200);
        $image_resize->save(public_path('storage/posts/'. $name));


        // $imagePath = $request->file('image')->store('posts', 'public');
        // $image = Image::make($request->file('image')->getRealPath())->resize(1200, 1200);
        // $image->save();


        auth()->user()->posts()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'image' => $name,
        ]);

        return redirect('/posts');
    }

    /**
     * |-----------------------------------------------
     * | Display a specific post on the page
     * |-----------------------------------------------
     * |
     * |
     */
    public function show(Post $post)
    {
        //
        $data = $post->views + 1;

        if($post) {
            $post->views = $data;
            $post->save();
        }
        
        $comments = $post->comments()->orderBy('created_at', 'DESC')->paginate(20);
        return view('posts.show', compact('post', 'comments'));
    }

    /**
     * |--------------------------------------------------------------
     * |    The ability to edit a current post and alter details
     * |--------------------------------------------------------------
     * |
     * |
     */
    public function edit(Post $post)
    {
        //
        $this->authorize('update', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * |--------------------------------------------------------------
     * |    This will take the edited details and update the DB
     * |--------------------------------------------------------------
     * |
     * |
     */
    public function update(Request $request, Post $post)
    {
        //
        $this->authorize('update', $post);

        $data = request()->validate([
            'title' => 'required|max:255|',
            'description' => 'required',
            'image' => 'image|',
        ]);

        $post->update($data);

        return redirect('/posts');
    }

    /**
     * |--------------------------------------------------------------
     * |    This function will delete the selected post
     * |--------------------------------------------------------------
     * |
     * |
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $this->authorize('delete', $post);

        $posts = Post::find($id)->delete();

        return redirect('/posts')->with('success', 'Post Removed');

    }
}
