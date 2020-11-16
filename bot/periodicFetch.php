<?php

require_once __DIR__ . '/commands/getTimetable.php';
require_once __DIR__ . '/commands/getMenu.php';

use DateTime;
use DateTimeZone;

function periodicFetch($discord) {
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));

    $sendMessage = null;

    if ($date->format('H') >= '7' && $date->format('H') < '8') {
        $sendMessage = getMenu('-1 day', 'now');
        $sendMessage .= "\n\n";
        $sendMessage .= getTimetable('+0 day', '+1 day');
    }

    if ($date->format('H') >= '20' && $date->format('H') < '21') {
        $sendMessage = getTimetable('+1 day', '+2 days');
    }

    if ($sendMessage === null) {
        return;
    }

    $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage($sendMessage, false);

    $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('**ATTENTION: des modifications non publiés sur pronote peuvent êtres apportées! Malgré ce bot, des erreurs peuvent survenir, vérifiez toujours depuis le site internet!**!', false);

    if ($GLOBALS['data']['notification']['everyone']) {
        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('@everyone', false);
    } elseif ($GLOBALS['data']['notification']['here']) {
        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('@here', false);
    }
}