<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = ['user_id', 'profession', 'about', 'location'];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
