<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('overlay', function ($user) {
    return true;
});

// Kept for backward compatibility — nothing broadcasts on the unscoped
// 'scoreboard' channel anymore. Live match updates now go out on a
// per-match channel (see below) so an overlay only receives events for
// the one match it's actually rendering.
Broadcast::channel('scoreboard', function ($user) {
    return true;
});

// Public (unauthenticated) per-match channel — the OBS browser-source
// overlay page has no logged-in user, so this can't be a private channel.
// Anyone with the match ID can listen, same as anyone with the overlay
// render URL can already view the overlay itself.
Broadcast::channel('scoreboard.{matchId}', function ($user) {
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