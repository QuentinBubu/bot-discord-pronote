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
        'fusionner 2 zéros',
        'préfixes: & ou pronote',
        'help: &help',
        'help: pronote help'
        ];
    $activity = $discord->factory(Activity::class, [
        'type' => Activity::TYPE_PLAYING,
        'name' => $playingTo[random_int(0, count($playingTo)-1)],
    ]);
    $discord->updatePresence($activity, false, 'online', false);
}