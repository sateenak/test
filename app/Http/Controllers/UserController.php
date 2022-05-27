<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Follow;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {

        $data = Follow::where('following_user_id', auth()->User()->id)->count();
        return view('profile', [
            'title' => 'profile',
            'posts' => Post::where('user_id', $user->id)->latest()->get(),
            'usere' => $user,
            'count2' => Post::where('user_id', $user->id)->get(),
            'count' => Post::where('user_id', auth()->user()->id)->get(),
            'followers' => $data,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $data = Follow::where('following_user_id', auth()->User()->id)->count();
        // return view('profile', [
        //     'title' => 'profile',
        //     'posts' => Post::where('user_id', $user->id)->latest()->get(),
        //     'usere' => $user,
        //     'count' => Post::where('user_id', $user->id)->get(),
        //     'followers' => $data,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $data = Follow::where('following_user_id', auth()->User()->id)->count();
        return view('editprofile', [
            'title' => 'Edit Profile',
            'posts' => Post::where('user_id', $user->id)->latest()->get(),
            'usere' => $user,
            'count' => Post::where('user_id', $user->id)->get(),
            'followers' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => 'required|max:500',
            'username' => 'required|min:4|max:300|unique:users,username,' . auth()->id(),
            'profile' => 'image|file|max:6000',
            'bio' => 'max:500'
        ];
        $validatedData = $request->validate($rules);
        if ($request->file('profile')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['profile'] = $request->file('profile')->store('profile-images');
        }
        User::where('id', $user->id)->update($validatedData);
        return redirect('/profile/' . $user->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
