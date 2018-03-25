<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('posts', 'PostController');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/profile/{username}', ['uses' => 'ProfileController@index', 'as' => 'profile']);

    Route::get('/profile/{username}/edit', ['uses' => 'ProfileController@edit', 'as' => 'profile.edit']);

    Route::post('/profile/{username}', ['uses' => 'ProfileController@update', 'as' => 'profile.update']);

    Route::get('/check_relationship_status/{id}', ['uses' => 'FriendshipController@check', 'as' => 'check']);

    Route::get('/add_friend/{id}', ['uses' => 'FriendshipController@add_friend', 'as' => 'add_friend']);

    Route::get('/accept_friend/{id}', ['uses' => 'FriendshipController@accept_friend', 'as' => 'accept_friend']);

    Route::get('/get_notifications', function (){
        return Auth::user()->unreadNotifications;
    });

    Route::get('/notifications', ['uses' => 'HomeController@notifications', 'as' => 'notifications']);
});



