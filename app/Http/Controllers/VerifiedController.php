<?php

namespace App\Http\Controllers;

use App\Verified;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
        $vposts = Verified::where('id', '>', 0)->orderBy('id', 'DESC')->paginate(15);

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
            'title' => 'required|max:255|string',
            'description' => 'required|string',
            'image' => 'required|image',
        ]);

        if($request->file('image')) {
            $file = $request->file('image');
            $string = Str::random(25);
            $name = $string.'.'.$file->getClientOriginalExtension();

            $dest = public_path('storage/posts/');
            $file->move($dest, $name);
            $input = $request->all();
            $input['image'] = $name;

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
        return view('verifieds.show', compact('verified'));
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
        //
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
            return view('home')->with('error', 'You do not have access to upload verified posts');
        }

        $verified->delete();
        return redirect('/v/posts')->with('success', 'Post Removed');
    }

    public function reactCount($id) {
        $reactant = Verified::find($id);
        $reactionCounters = $reactant->getReactionCounters;
    }
}
