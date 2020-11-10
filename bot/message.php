<?php

require_once 'commands/notification.php';
require_once 'commands/server.php';

function newMessage(&$message) {
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

            case 'help';
                $text = json_encode($GLOBALS['data']['commands'], JSON_PRETTY_PRINT);
                $message->reply("```json\n{$text}\n```", false);
            break;

            case 'setNotificationChannel';
                setNotificationChannel($message, $details['value']);
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

            default;
                $message->reply('Oh non, commande inconnue... `pronote help`');
        }
    }
}