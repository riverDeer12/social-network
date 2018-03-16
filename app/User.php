<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, Friendable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'name', 'username', 'dob', 'cover', 'avatar', 'email',  'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     *
     * @var array
     */
    protected $dates = ['dob'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
