<?php

function notificationInformation() {
    return $GLOBALS['data']['notification'];
}

function setNotificationChannel(&$message, $channel) {
    $GLOBALS['data']['notification']['channel'] = "<#{$channel}>";
    $message->reply("Maintenant, le channel pour les notifications est {$GLOBALS['data']['notification']['channel']}!");
}

function setNotificationEveryone(&$message, $value) {
    $GLOBALS['data']['notification']['everyone'] = (bool) $value;
    $message->reply("Updated", false);
}

function setNotificationHere(&$message, $value) {
    $GLOBALS['data']['notification']['here'] = (bool) $value;
    $message->reply("Updated", false);
}
