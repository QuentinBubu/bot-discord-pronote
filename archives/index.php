<?php

header('Content-Type application/json');

require 'credentials.php';
require 'graphqlData/variables.php';

header('Content-Type application/json');

require 'credentials.php';

function getCurl(
    array $header = array(
        'Content-Type: application/json',
        'token:' . json_decode($token = '', true)['token']
    ),
    string $url = '127.0.0.1:21727/auth/login',
    string $data
) {
    $curl = curl_init();
    curl_setopt_array(
        $curl,
        [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
        ]
    );
    $result  = curl_exec($curl);
    curl_close($curl);
    return $result;
}

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
);

var_dump($token);

$request = '{"query":"' . $file ?? file_get_contents('graphqlData/schema.graphql') .'",'. substr(getVariables(), 1, -1) .',"operationName":"timetable"}';

$data = getCurl(
    [
        'Content-Type: application/json',
        'token:' . json_decode($token, true)['token']
    ],
    '127.0.0.1:21727/graphql',
    $request
);