<?php

use DateTime;
use DateTimeZone;

function periodicFetch($discord) {
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));

    if ($date->format('H') >= '7' && $date->format('H') <= '8') {
        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('**ATTENTION: des modifications non publiés sur pronote peuvent êtres apportées! Malgré ce bot, des erreurs peuvent survenir, vérifiez toujours depuis le site internet!**!', false);
    }
}