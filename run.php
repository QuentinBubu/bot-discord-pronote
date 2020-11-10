<?php

include __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/credentials.php';
require __DIR__ . '/bot/MyFunctions.php';
require __DIR__ . '/bot/message.php';
require __DIR__ . '/bot/globalArray.php';
// require __DIR__ . '/index.php';
require __DIR__ . '/bot/periodicFetch.php';

use Discord\DiscordCommandClient;
use Illuminate\Support\Facades\Date;

$discord = new DiscordCommandClient([
  'token' => $tokenBot,
  'prefix' => 'pronote ',
]);

$discord->on('ready', function ($discord) {
    echo "Bot is ready.", PHP_EOL;
    $discord->on('message', function ($message) {
        echo "Recieved a message from {$message->author->username}: {$message->content}", PHP_EOL;
        newMessage($message);
    });

    $discord->loop->addPeriodicTimer(60, function () use ($discord) {
        updateRichPresence($discord);
    });

    $discord->loop->addPeriodicTimer(60*31, function () use ($discord) {
        $date = new Date('now');
    });
});

/*$game = $discord->factory(Game::class, [
    'state' => 'Nombre de 0 mis:',
    'details' => 'Joue à mettre des 0 à tout le monde',
    'startTimestamp' => 1507665886,
    'endTimestamp' => 1507665886,
    'largeImageKey' => 'favicon',
    'largeImageText' => 'Pronote',
    'smallImageKey' => 'pronote-not',
    'smallImageText' => 'NOT',
    'partyId' => 0,
    'partySize' => 24,
    'partyMax' => 100
]
[
    'name' => 'Nombre de 0 mis:',
    'url' => '0',
    'type' => 0,
    'created_at' => 0,
    'timestamps' => [1507665886, 1507665886],
    'application_id' => '0',
    'details' => 'Joue à mettre des 0 à tout le monde',
    'state' => 'Nombre de 0 mis:',
    'emoji' => 00,
    'party' => 0
]);
*/




$discord->registerCommand('ping', function () {
    return 'pong!';
},
[
    'description' => 'pong!',
]
);

// $discord->registerCommand('', ['hey', 'hello'], ['aliases' => ['1', '2', '3']]);

// $discord->guilds[741229545579085876]->channels[774948551217119232]->sendMessage('Hello!', false);





$discord->run();