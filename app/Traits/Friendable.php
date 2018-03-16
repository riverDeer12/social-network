<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{
    public function add_friend($requested_user_id)
    {
        if ($this->id == $requested_user_id) {
            return 0;
        }

        if ($this->has_pending_friend_request_sent_to($requested_user_id) == 1) {
            return response()->json('Already sent friend request');
        }

        if ($this->is_friend_with($requested_user_id) == 1) {
            return response()->json('Already friends');
        }

        if ($this->has_pending_friend_request_from($requested_user_id) == 1) {
            return $this->accept_friend($requested_user_id);
        }

        $friendship = Friendship::create([
            'requester' => $this->id,
            'requested_user' => $requested_user_id,
        ]);

        if ($friendship) {
            return 1;
        }

        return 0;
    }

    public function accept_friend($requester)
    {
        if ($this->has_pending_friend_request_from($requester) == 0) {
            return 0;
        }

        $friendship = Friendship::where('requester', $requester)->where('requested_user', $this->id)->first();

        if ($friendship) {
            $friendship->update([
                'status' => 1
            ]);

            return 1;
        }

        return 0;
    }

    public function friends()
    {
        $friends1 = array();
        $f1 = Friendship::where('status', 1)->where('requester', $this->id)->get();

        foreach ($f1 as $friendship):
            array_push($friends1, User::find($friendship->requested_user));
        endforeach;

        $friends2 = array();
        $f2 = Friendship::where('status', 1)->where('requested_user', $this->id)->get();

        foreach ($f2 as $friendship):
            array_push($friends2, User::find($friendship->requester));
        endforeach;

        return array_merge($friends1, $friends2);
    }


    public function pending_friend_requests()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)->where('requested_user', $this->id)->get();

        foreach ($friendships as $friendship):
            array_push($users, User::find($friendship->requester));
        endforeach;

        /* array of users with pending requests */
        return $users;
    }


    public function friends_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    public function pending_friend_requests_ids()
    {
        return collect($this->pending_friend_requests())->pluck('id')->toArray();
    }


    public function is_friend_with($user_id)
    {
        if (in_array($user_id, $this->friends_ids())) {
            return 1;
        } else {
            return 0;
        }
    }

    public function pending_friend_requests_sent()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)->where('requester', $this->id)->get();

        foreach ($friendships as $friendship):
            array_push($users, User::find($friendship->requested_user));
        endforeach;

        return $users;

    }

    public function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    public function has_pending_friend_request_from($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_ids())) {
            return 1;
        } else {
            return 0;
        }
    }

    public function has_pending_friend_request_sent_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids())) {
            return 1;
        } else {
            return 0;
        }
    }


}