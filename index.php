<?php

header('Content-Type application/json');

require 'credentials.php';
require 'graphqlData/variables.php';

function getCurl($header, $url, $data) {
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


$token = '{"token":"89e1734e-b823-4460-9a32-5a086da5f5d2"}';

$request = '{"query":"' . file_get_contents('graphqlData/schema.graphql') .'",'. substr(getVariables(), 1, -1) .',"operationName":"timetable"}';
var_dump($request);


$data = getCurl(
    [
        'Content-Type: application/json',
        'token:' . json_decode($token, true)['token']
    ],
    '127.0.0.1:21727/graphql',
    $request
);

echo '<pre>';
var_dump($token);
var_dump($data);
echo '</pre>';