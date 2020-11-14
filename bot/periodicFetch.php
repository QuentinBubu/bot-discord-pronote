<?php

use DateTime;
use DateTimeZone;

function periodicFetch($discord) {
    $date = new DateTime('now', new DateTimeZone('Europe/Paris'));

    if ($date->format('H') >= '22' && $date->format('H') < '23phpp ') {
        $courses = getData(
            'getCourses',
            [
                'variables' => [
                    'timetableFrom' => date('Y-m-d', strtotime("+3 day")),
                    'timetableTo' => date('Y-m-d', strtotime("+4 days"))
                ]
            ]
        );

        $courses = json_decode($courses, true);

        $sendMessage = "Cours de la journée:\n";
        foreach ($courses['data']['timetable'] as $value) {
            if (!$value['isCancelled']) {

                if ($value['status'] == null) {
                    $value['status'] = 'aucun';
                }

                $sendMessage .= "*De " . date('H\hi', $value['from']/1000) . " à " . date('H\hi', $value['to']/1000) . "*\nCours de " . $value['subject'] . " avec " . $value['teacher'] . " en salle " . $value['room'] . ".\nStatut particulier: " . $value['status'];
                $sendMessage .= "\n\n-----\n\n";
            }
        }

        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage($sendMessage, false);

        $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('**ATTENTION: des modifications non publiés sur pronote peuvent êtres apportées! Malgré ce bot, des erreurs peuvent survenir, vérifiez toujours depuis le site internet!**!', false);

        if ($GLOBALS['data']['notification']['everyone']) {
            $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('@everyone', false);
        } elseif ($GLOBALS['data']['notification']['here']) {
            $discord->guilds[$GLOBALS['data']['server']['serverId']]->channels[$GLOBALS['data']['notification']['channel']]->sendMessage('@here', false);
        }

    }
}