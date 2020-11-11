<?php

use Discord\Parts\User\Activity;

function initConfiguration(&$discord) {
    $activity = $discord->factory(Activity::class, [
        'type' => Activity::TYPE_PLAYING,
        'name' => 'Please, send message for init!',
    ]);
    $discord->updatePresence($activity, false, 'online', false);
    while (true) {
        $discord->on('message', function ($message) {
            echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
            newMessage($message);
        });
    }
}