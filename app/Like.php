<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public $fillable = ['user_id', 'post_id'];

    public $with = ['user'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }


}
