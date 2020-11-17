<?php

require_once 'commands/notification.php';
require_once 'commands/server.php';
require_once 'commands/getMenu.php';
require_once 'commands/getTimetable.php';

function newMessage(&$message, &$discord) {
    if (
        in_array($message->content[0], $GLOBALS['data']['prefix'])
        || in_array(explode(' ', $message->content)[0], $GLOBALS['data']['prefix'])
    ) {

        if (in_array($message->content[0], $GLOBALS['data']['prefix'])) {
            $details = [
                'prefix' => $message->content[0],
                'command' => substr(explode(' ', $message->content)[0], 1),
                'value' => explode(' ', $message->content)[1] ?? null
            ];
        } elseif (in_array(explode(' ', $message->content)[0], $GLOBALS['data']['prefix'])) {
            $details = [
                'prefix' => explode(' ', $message->content)[0],
                'command' => explode(' ', $message->content)[1],
                'value' => explode(' ', $message->content)[2] ?? null
            ];
        }

        switch ($details['command']) {

            case 'commandList';
                $text = json_encode($GLOBALS['data']['commands']['Commands_informations'], JSON_PRETTY_PRINT);
                $message->reply("```json\n{$text}\n```", false);
            break;

            case 'help';
                $text = json_encode($GLOBALS['data']['commands']['Commands_informations'][$details['value']], JSON_PRETTY_PRINT);
                $message->reply("```json\n{$text}\n```", false);
            break;

            case 'setNotificationChannel';
                setNotificationChannel($message, $details['value']);
            break;

            case 'setNotificationEveryone';
                setNotificationEveryone($message, $details['value']);
            break;

            case 'setNotificationHere';
                setNotificationHere($message, $details['value']);
            break;

            case 'notificationInformation';
                $text = json_encode(notificationInformation(), JSON_PRETTY_PRINT);
                $message->reply("```json\n{$text}\n```", false);
            break;

            case 'setServerId';
                setServerId($message, $details['value']);
            break;

            case 'everyone';
                $message->reply('@everyone', false);
            break;

            case 'addPrefix';
                addPrefix($message, $details['value']);
            break;

            case 'init';
                if ($GLOBALS['data']['notification']['channel'] === null) {
                    $GLOBALS['data']['notification']['channel'] = $message->channel_id;
                    $guild   = $discord->guilds->first();
                    $GLOBALS['data']['server']['serverId'] = $guild->channels->get('id', "{$GLOBALS['data']['notification']['channel']}")->guild_id;
                }
            break;

            case 'serverInformation';
                $text = json_encode($GLOBALS['data']['server'], JSON_PRETTY_PRINT);
                $message->reply("```json\n{$text}\n```", false);
            break;

            case 'setEchoMenu';
                setEchoMenu($message, $details['value']);
            break;

            case 'setEchoTimetable';
                setEchoMenu($message, $details['value']);
            break;

            case 'sendMenu';
                $message->reply(getMenu('-1 day', 'now', true), true);
            break;

            case 'sendTimetable';
                $message->reply(getTimetable('now', '+1 day', true), true);
            break;

            default;
                $message->reply('Oh non, commande inconnue... `pronote help`');
        }
    }
}