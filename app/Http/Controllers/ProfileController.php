<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($username)
    {
        $user = User::where('username', $username)->first();
        return view('profiles.profile')->with('user', $user);
    }

    public function edit($username)
    {
        $user = User::where('username', $username)->first();

        if (Auth::user()->id != $user->id) {
            return redirect()->back();
        }
        return view('profiles.edit')->with('user', $user);
    }

    public function update($username, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::where('username', $username)->first();
        $profile = Profile::findOrFail($user->id);

        $user->gender = $request->get('gender');
        $user->name = $request->get('name');

        // updating cover image //
        if ($request->hasFile('cover')) {
            Auth::user()->update([
                'cover' => $request->cover->store('public/covers')
            ]);
        }

        // updating avatar image //
        if ($request->hasFile('avatar')) {
            Auth::user()->update([
                'avatar' => $request->avatar->store('public/avatars')
            ]);
        }

        $profile->location = $request->get('location');
        $profile->about = $request->get('about');
        $profile->profession = $request->get('profession');

        $user->save();
        $profile->save();

        $request->session()->flash('alert-success', 'Profile was successfully updated!');

        return redirect('/profile/' . $username);
    }

    public function wall_posts($user_id)
    {
        $user = User::where('id', $user_id)->first();

        $wallPosts = array();

        foreach ($user->posts->sortByDesc('created_at') as $wallPost):
            array_push($wallPosts, $wallPost);
        endforeach;

        return $wallPosts;
    }
}
