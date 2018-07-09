<?php


Broadcast::channel('messages.{id}', function ($user, $id) {
    return $user->id == (int) $id;
});

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


