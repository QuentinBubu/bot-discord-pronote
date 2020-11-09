<?php

$GLOBALS['data'] = [];

$GLOBALS['data']['notification'] = [
    'channel' => null
];

$GLOBALS['data']['prefix'] = [
    'pronote',
    '&'
];

$GLOBALS['data']['commands'] = [
    'Commands informations' => [
        'help' => [
            'Name' => 'help',
            'Description' => 'Command help you with others commands',
            'Usage' => '`pronote help`'
        ],
        'notificationInformation' => [
            'Name' => 'notificationInformation',
            'Description' => 'Command return information about channel',
            'Usage' => '`pronote notificationInformation`'
        ],
        'setNotificationChannel' => [
            'Name' => 'setNotificationChannel',
            'Description' => 'Command set channel where pronote informations will be send',
            'Usage' => '`pronote setNotificationChannel CHANNEL_ID`'
        ],
    ]
];
