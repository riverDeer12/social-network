<?php

namespace App\Http\Controllers;

use App\Notifications\NewFriendRequest;
use App\Traits\Friendable;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    use Friendable;

    public function check($id)
    {
        if (Auth::user()->is_friend_with($id) === 1) {
            return ['status' => 'friends'];
        }

        if (Auth::user()->has_pending_friend_request_from($id)) {
            return ['status' => 'pending'];
        }

        if (Auth::user()->has_pending_friend_request_sent_to($id)) {
            return ['status' => 'waiting'];
        }

        if (Auth::user()->id == $id) {
            return ['status' => 'Your profile'];
        }

        return ['status' => 0];
    }

    public function add_friend($id)
    {
        $resp =  Auth::user()->add_friend($id);

        User::find($id)->notify(new NewFriendRequest(Auth::user()));

        return $resp;
    }

    public function accept_friend($id)
    {
        return Auth::user()->accept_friend($id);
    }
}
