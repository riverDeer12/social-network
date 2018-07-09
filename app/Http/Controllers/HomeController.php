<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function notifications()
    {
        Auth::user()->unreadNotifications->markAsRead(); // by default sorted created_at
        return view('notifications')->with('notifications', Auth::user()->notifications);
    }
}
