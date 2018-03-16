<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['user_id', 'description', 'location', 'title', 'image'];

    /**
     * Relationships
     *
     */

    public function user(){
        return $this->belongsTo(User::class);
    }

}
