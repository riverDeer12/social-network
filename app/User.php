<?php

namespace App;

use App\Traits\Friendable;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable, Friendable, Searchable;

    protected $fillable = ['gender', 'name', 'username', 'dob', 'cover', 'avatar', 'email', 'password'];

    protected $dates = ['dob'];

    protected $hidden = ['password', 'remember_token'];

    public function getAvatarAttribute($avatar)
    {
        return asset(Storage::url($avatar));
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }


}
