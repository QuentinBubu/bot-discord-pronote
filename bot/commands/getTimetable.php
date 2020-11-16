<?php


function getTimetable($from, $to) {
    $courses = getData(
        'getCourses',
        [
            'variables' => [
                'timetableFrom' => date('Y-m-d', strtotime($from)),
                'timetableTo' => date('Y-m-d', strtotime($to))
            ]
        ]
    );

    $courses = json_decode($courses, true);

    $sendMessage = "Prochains cours:\n";
    foreach ($courses['data']['timetable'] as $value) {
        if (!$value['isCancelled']) {
            if ($value['status'] == null) {
                $value['status'] = 'aucun';
            }

            $sendMessage .= "*De " . date('H\hi', $value['from']/1000) . " à " . date('H\hi', $value['to']/1000) . "*\nCours de " . $value['subject'] . " avec " . $value['teacher'] . " en salle " . $value['room'] . ".\nStatut particulier: " . $value['status'];
            $sendMessage .= "\n\n-----\n\n";
        }
    }
}
