<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('live-bidding-channel', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('everywhere', function ($user) {
    return $user;
});

// FIXME: User Model
Broadcast::channel('chat.{roomId}', function ($user, $roomId) {
    return $user;
});
