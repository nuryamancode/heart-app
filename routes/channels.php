<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('user-chat', function ($user, $id): bool {
    return true;
});
