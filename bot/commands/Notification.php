<?php

function notificationInformation() {
    return $GLOBALS['data']['notification'];
}

function setNotificationChannel(&$message, $channel) {
    $GLOBALS['data']['notification']['channel'] = "<#{$channel}>";
    $message->reply("now, notification channel is {$GLOBALS['data']['notification']['channel']}!");
}
