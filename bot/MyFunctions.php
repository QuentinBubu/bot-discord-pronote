<?php

use Discord\Parts\User\Activity;

function updateRichPresence(&$discord) {
    $playingTo = [
        'mettre des 0',
        'please, wait, bug bug bug bug... Oups I have delete all grades...',
        'rajouter du travail',
        'changer les mots de passes',
        'mettre des trolls',
        'réciter sa leçon',
        'observer',
        'voler avec ses papillons',
        'se démonter',
        'essayer de diviser par 0',
        'mettre des bas coefficients sur des bonnes notes',
        'fusionner 2 zéros',
        'préfixes: ' . json_encode($GLOBALS['data']['prefix']),
        'help: &help',
        'help: pronote help',
        'Créateur: Quentin_bubu'
        ];
    $activity = $discord->factory(Activity::class, [
        'type' => Activity::TYPE_PLAYING,
        'name' => $playingTo[random_int(0, count($playingTo)-1)],
    ]);
    $discord->updatePresence($activity, false, 'online', false);
}

function getCurl(
    array $header,
    string $data,
    string $url = '127.0.0.1:21727/graphql'
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

function getData(string $file, array $variables) {

    $casInfos = [
        'url' => $GLOBALS['credentials']['url_pronote'],
        'username' => $GLOBALS['credentials']['username'],
        'password' => $GLOBALS['credentials']['password'],
        'cas' => $GLOBALS['credentials']['cas']
    ];

    $token = getCurl(
        [
            'Content-Type: application/json'
        ],
        json_encode($casInfos),
        '127.0.0.1:21727/auth/login'
    );

    $request = '{"query":"' . file_get_contents(__DIR__ . '/../graphqlData/' . $file . '.graphql') .'",'. substr(json_encode($variables), 1, -1) .',"operationName":"variable"}';

    $data = getCurl(
        [
            'Content-Type: application/json',
            'token:' . json_decode($token, true)['token']
        ],
        $request
    );
    return $data;
}