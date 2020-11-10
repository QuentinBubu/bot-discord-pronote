<?php

function setServerId(&$message, int $serverId) {
    $GLOBALS['data']['server']['serverId'] = $serverId;
    $message->reply('Id du server changée!', false);
}

function addPrefix(&$message, string $prefix) {
    array_push($GLOBALS['data']['prefix'], $prefix);
    $message->reply('Préfixe ajouté, liste des préfixes:`' . json_encode($GLOBALS['data']['prefix']) . '`', false);
}