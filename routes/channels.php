<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('chat.{receiverId}', function ($user, $receiverId) {
    \Log::info('Broadcast Auth Check', [
        'user' => $user,
        'receiverId' => $receiverId
    ]);

    return true;
});
