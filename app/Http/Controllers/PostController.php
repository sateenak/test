<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Post $post)
    {
        $user = Auth::user()->follows->pluck('id');

        $postsaya = Post::whereIn('user_id', $user)->orWhere('user_id', Auth::user()->id)->latest()->get();
        $data = Follow::where('following_user_id', auth()->User()->id)->count();
        return view('feed', [
            'title' => 'feed',
            'posts' => $postsaya,
            'user' => auth()->User()->id,
            'count' => Post::where('user_id', auth()->user()->id)->get(),
            'followers' => $data,
            'likeUser' => Like::where('user_id', auth()->user()->id)->pluck('user_id'),
            'likePost' => Like::where('user_id', auth()->user()->id)->pluck('post_id')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        $data = Follow::where('following_user_id', auth()->User()->id)->count();
        return view('create', [
            'title' => 'create',
            'count' => $post->where('user_id', auth()->User()->id)->get(),
            'followers' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:500',
            'image' => 'required',
            'image.*' => 'file|max:6000'
        ]);
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $imageSolo) {
                // $name = auth()->user()->id . time() . rand(1, 1000) . '.' . $imageSolo->extension();
                // $imageSolo->move(public_path('storage/imgpost'), $name);
                $name = $imageSolo->store('imageini');
                $data[] = $name;
            }
            Post::create([
                'user_id' => auth()->user()->id,
                'content' => $request->content,
                'image' => base64_encode(serialize($data))
            ]);
        }
        // $posting = new Post();
        // $posting->user_id = auth()->user()->id;
        // $posting->content = $request->content;
        // $posting->image = json_encode($data);
        // $posting->save();
        // $validatedData['image'] = $request->file('image')->store('post-images');

        // $validatedData['image'] = $request->file('image')->store('post-images');
        // $validatedData['user_id'] = auth()->user()->id;
        // Post::create($validatedData);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $data = Follow::where('following_user_id', auth()->User()->id)->count();
        return view('edit', [
            'title' => 'edit',
            'count' => $post->where('user_id', auth()->User()->id)->get(),
            'post' => $post,
            'followers' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'content' => 'required|max:500',
            'image' => 'image|file|max:6000'
        ];
        $validatedData = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['user_id'] = auth()->user()->id;
        Post::where('id', $post->id)->update($validatedData);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            foreach (unserialize(base64_decode($post->image)) as $imm) {
                Storage::delete($imm);
            }
        }
        $post->delete();
        return redirect('/feed');
    }
}
