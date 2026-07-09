<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('overlay', function ($user) {
    return true;
});

Broadcast::channel('scoreboard', function ($user) {
    return true;
});

Broadcast::channel('notifications', function ($user) {
    return true;
});

Broadcast::channel('chat', function ($user) {
    return true;
});

Broadcast::channel('bracket', function ($user) {
    return true;
});
