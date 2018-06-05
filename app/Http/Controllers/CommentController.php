<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use App\Events\NewComment;

class CommentController extends Controller
{
    public function get_comments($post_id)
    {
        $comments = Comment::where('post_id', $post_id)->get();

        return response()->json($comments);
    }

    public function new_comment(Request $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $request->post_id,
            'content' => $request->content
        ]);

        return response()->json($comment);
    }


}
