<?php

function notificationInformation() {
    return $GLOBALS['data']['notification'];
}

function setNotificationChannel(&$message, $channel) {
    $GLOBALS['data']['notification']['channel'] = "<#{$channel}>";
    $message->reply("maintenant, le channel pour les notifications est {$GLOBALS['data']['notification']['channel']}!");
}
