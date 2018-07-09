<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function store(Request $request)
    {
        return Post::create([
            'content' => $request->get('content'),
            'user_id' => Auth::id()
        ]);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->content = $request->get('content');
        $post->save();
        return response()->json($post);
    }


    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return $id;
    }
}
