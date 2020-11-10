<?php

header('Content-Type application/json');

require 'credentials.php';
require 'graphqlData/variables.php';
require 'gettoken.php';

/*
$casInfos = [
    'url' => $url_pronote,
    'username' => $username,
    'password' => $password,
    'cas' => $cas
];

$token = getCurl(
    [
        'Content-Type: application/json'
    ], 
    '127.0.0.1:21727/auth/login',
    json_encode($casInfos)
);*/

$request = '{"query":"' . $file ?? file_get_contents('graphqlData/schema.graphql') .'",'. substr(getVariables(), 1, -1) .',"operationName":"timetable"}';

$data = getCurl(
    [
        'Content-Type: application/json',
        'token:' . json_decode($token, true)['token']
    ],
    '127.0.0.1:21727/graphql',
    $request
);