<?php

use DateTime;
use DateTimeZone;

function periodicFetch($discord) {
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));

    if ($date->format('H') >= '17' && $date->format('H') < '18') {
        $courses = getData(
            'getCourses',
            [
                'variables' => [
                    'timetableFrom' => date('Y-m-d', strtotime("+1 day")),
                    'timetableTo' => date('Y-m-d', strtotime("+2 days"))
                ]
                ]
        );

        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage("```json\n{$courses}\n```", false);

        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('**ATTENTION: des modifications non publiés sur pronote peuvent êtres apportées! Malgré ce bot, des erreurs peuvent survenir, vérifiez toujours depuis le site internet!**!', false);
    }
}