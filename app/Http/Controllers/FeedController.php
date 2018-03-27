<?php

namespace App\Http\Controllers;

use App\Post;
use App\Traits\Friendable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    use Friendable;

    public function feed()
    {
        $friends = Auth::user()->friends();

        $feed = array();

        foreach ($friends as $friend):
            foreach ($friend->posts as $post):
                array_push($feed, $post);
            endforeach;
        endforeach;

        return $feed;
    }
}
