<?php

include __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/credentials.php';
require __DIR__ . '/bot/MyFunctions.php';
require __DIR__ . '/bot/message.php';
require __DIR__ . '/bot/globalArray.php';
require __DIR__ . '/bot/periodicFetch.php';

use Discord\Parts\User\Activity;
use Discord\DiscordCommandClient;

$discord = new DiscordCommandClient([
  'token' => $credentials['tokenBot'],
  'prefix' => 'pronote ',
]);

$discord->on('ready', function ($discord) {

    echo "Bot is ready.", PHP_EOL;

    $activity = $discord->factory(Activity::class, [
        'type' => Activity::TYPE_PLAYING,
        'name' => 'PLEASE, SEND MESSAGE `pronote init` IN YOUR NOTIFICATION CHANNEL FOR INIT BOT!',
    ]);
    $discord->updatePresence($activity, false, 'online', false);

    //periodicFetch($discord);

    $discord->on('message', function ($message) {
        echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
        newMessage($message);
    });

    $discord->loop->addPeriodicTimer(60, function () use ($discord) {
        if ($GLOBALS['data']['notification']['channel'] !== null) {
            updateRichPresence($discord);
        }
    });

    $guild   = $discord->guilds->first();
    $channel = $guild->channels->get('id', '774948551217119232');
    var_dump($channel);

    //$discord->loop->addPeriodicTimer(60*31, function () use ($discord) {
    //    periodicFetch($discord);
    //});
});

$discord->registerCommand('ping', function () {
    return 'pong!';
},
[
    'aliases' => $GLOBALS['data']['prefix']
]
);

// $discord->registerCommand('', ['hey', 'hello'], ['aliases' => ['1', '2', '3']]);

// $discord->guilds[741229545579085876]->channels[774948551217119232]->sendMessage('Hello!', false);

$discord->run();