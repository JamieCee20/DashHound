<?php

namespace App\Http\Controllers;

use App\Like;
use App\Verified;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as Image;

class VerifiedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vposts = Verified::orderBy('id', 'DESC')->paginate(15);
        return view('verifieds.index', compact('vposts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('post-verified-create')) {
            return view('welcome');
        }
        return view('verifieds.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if(Gate::denies('post-verified-create')) {
            return view('welcome')->with('error', 'You do not have access to upload verified posts');
        }
        $data = $request->validate([
            'title' => 'required|min:3|max:50|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        if($request->file('image')) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();

            $image_resize = Image::make($file->getRealPath());
            $image_resize->resize(1200, 1200);
            $image_resize->save('storage/posts/'.$name);

            auth()->user()->vposts()->create([
                'title' => $data['title'],
                'description' => $data['description'],
                'image' => $name,
            ]);
        } 
        return redirect('/v/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Verified  $verified
     * @return \Illuminate\Http\Response
     */
    public function show(Verified $verified)
    {
        $likes = Like::where('verified_id', $verified->id)->get();
        return view('verifieds.show', compact('verified', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Verified  $verified
     * @return \Illuminate\Http\Response
     */
    public function edit(Verified $verified)
    {
        if(Gate::denies('post-verified-create')) {
            return view('home')->with('error', 'You do not have access to upload verified posts');
        }

        $this->authorize('update', $verified);
        return view('verifieds.edit', compact('verified'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Verified  $verified
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Verified $verified)
    {
        if(Gate::denies('post-verified-create')) {
            return view('home')->with('error', 'You do not have access to upload verified posts');
        }

        $this->authorize('update', $verified);

        $data = request()->validate([
            'title' => 'required|min:3|max:50|string',
            'description' => 'required',
            'image' => 'image|',
        ]);

        $verified->update($data);

        return redirect('/v/posts')->with('success', 'Post successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Verified  $verified
     * @return \Illuminate\Http\Response
     */
    public function destroy(Verified $verified)
    {
        if(Gate::denies('post-verified-create')) {
            return view('home')->with('error', 'You do not have access to delete verified posts');
        }

        $verified->delete();
        return redirect('/v/posts')->with('success', 'Post Removed');
    }
}
