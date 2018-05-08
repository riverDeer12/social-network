<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function messages($username){
        $user = User::where('username', $username)->first();
        return view('messages')->with('user', $user);
    }
}
