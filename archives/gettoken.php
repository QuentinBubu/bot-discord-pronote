<?php

header('Content-Type application/json');

require '../credentials.php';

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

$casInfos = [
    'url' => $credentials['url_pronote'],
    'username' => $credentials['username'],
    'password' => $credentials['password'],
    'cas' => $credentials['cas']
];

$token = getCurl(
    [
        'Content-Type: application/json'
    ], 
    '127.0.0.1:21727/auth/login',
    json_encode($casInfos)
);

var_dump($token);