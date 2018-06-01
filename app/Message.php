<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'from', 'to'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
