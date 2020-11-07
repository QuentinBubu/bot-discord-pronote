<?php

function getVariables() {
    $data = ['variables' => [
        'timetableFrom' => date('Y-m-d'),
        'timetableTo' => date('Y-m-d', strtotime("+1 day"))
    ]];
    return json_encode($data);
}