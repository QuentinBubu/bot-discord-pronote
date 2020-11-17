<?php

$GLOBALS['data'] = [];

$GLOBALS['data']['notification'] = [
    'channel' => null,
    'everyone' => false,
    'here' => false,
    'menu' => true,
    'timetable' => true
];

$GLOBALS['data']['prefix'] = [
    'pronote',
    '&'
];

$GLOBALS['data']['commands'] = [
    'Commands_informations' => [
        'commandList' => [
            'Name' => 'commandList',
            'Description' => 'Command who send all commands',
            'Usage' => '`pronote commandList`'
        ],
        'help' => [
            'Name' => 'help',
            'Description' => 'Command help you with others commands',
            'Usage' => '`pronote help command`'
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
        'setNotificationEveryone' => [
            'Name' => 'setNotificationEveryone',
            'Description' => 'Command for set if you would ping everyone. It\'s here or everyone',
            'Usage' => '`pronote setNotificationEveryone true or false`'
        ],
        'setNotificationHere' => [
            'Name' => 'setNotificationHere',
            'Description' => 'Command for set if you would ping here. It\'s here or everyone',
            'Usage' => '`pronote setNotificationEveryone true or false`'
        ],
        'setServerId' => [
            'Name' => 'setServerId',
            'Description' => 'Command for set ID of server',
            'Usage' => '`pronote setServerId SERVER_ID`'
        ],
        'addPrefix' => [
            'Name' => 'addPrefix',
            'Description' => 'Command for add bot prefix',
            'Usage' => '`pronote addPrefix PREFIX`'
        ],
        'init' => [
            'Name' => 'init',
            'Description' => 'Command for init bot',
            'Usage' => '`pronote init`'
        ],
        'serverInformation' => [
            'Name' => 'serverInformation',
            'Description' => 'Command for get server information',
            'Usage' => '`pronote serverInformation`'
        ],
        'setEchoMenu' => [
            'Name' => 'setEchoMenu',
            'Description' => 'Command for set if you would of menu was send or not',
            'Usage' => '`pronote setEchoMenu true/false`'
        ],
        'setEchoTimetable' => [
            'Name' => 'setEchoTimetable',
            'Description' => 'Command for set if you would of timetable was send or not',
            'Usage' => '`pronote setEchoTimetable true/false`'
        ],
        'getMenu' => [
            'Name' => 'getMenu',
            'Description' => 'Command for send today menu',
            'Usage' => '`pronote getMenu`'
        ],
        'getTimetable' => [
            'Name' => 'getTimetable',
            'Description' => 'Command for send today timetable',
            'Usage' => '`pronote getTimetable`'
        ],
    ]
];

$GLOBALS['data']['server'] = [
    'serverId' => null
];