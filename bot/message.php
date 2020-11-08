<?php

use Discord\Factory\Factory;
use Discord\Http\Http;
use Discord\Parts\Channel\Channel;
use Discord\Parts\Channel\Message;

function newMessage($message, &$discord) {
    $prefix = ['&', 'pronote'];
    if (
        in_array($message->content[0], $prefix)
        || in_array(explode(' ', $message->content)[0], $prefix)
    ) {
        $message->reply('Hello you');
        $messageSend = new Channel($discord->factory(), $discord, $discord->http);
        $messageSend->sendMessage('test');
    }
}