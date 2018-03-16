<?php

namespace App\Http\Controllers\Auth;

use App\Profile;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'gender' => 'required|bool',
            'name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $default_cover = 'public/defaults/covers/cover.png';

        if($data['gender']){
            $avatar = 'public/defaults/avatars/male.png';
        }else{
            $avatar = 'public/defaults/avatars/female.png';
        }

        $user = User::create([
            'gender' => $data['gender'],
            'name' => $data['name'],
            'username' => str_slug($data['name']),
            'dob' => $data['dob'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cover' => $default_cover,
            'avatar' => $avatar,
        ]);

        /* create user_id for profile table every time new user is created */
        Profile::create(['user_id' => $user->id]);

        return $user;
    }
}
