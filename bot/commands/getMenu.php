<?php

function getMenu($from, $to, $pass = false) {
    if ($GLOBALS['data']['notification']['timetable'] || $pass) {
        $menu = getData(
            'getMenu',
            [
            'variables' => [
                'menuFrom' => date('Y-m-d', strtotime($from)),
                'menuTo' => date('Y-m-d', strtotime($to))
            ]
        ]
        );

        $menu = json_decode($menu, true);

        $sendMessage = "**Menu du " . date('d/m', strtotime('+1 day', $menu['data']['menu'][0]['date']/1000)) . ":**\n";

        foreach ($menu['data']['menu'][0]['meals'] as $key => $value) {
            if ($key === 0) {
                $sendMessage .= "\n**~Le midi:~**\n";
            } elseif ($key === 1) {
                $sendMessage .= "\n**~Le soir:~**\n";
            }
            $aliment = count($value);

            foreach ($value as $key => $value) {
                if ($key === 0) {
                    $sendMessage .= "\n> Entrée(s):\n";
                }
                if ($aliment === 4) {
                    if ($key === 1) {
                        $sendMessage .= "\n> Plat(s):\n";
                    } elseif ($key === 2) {
                        $sendMessage .= "\n> Fromage(s):\n";
                    } elseif ($key === 3) {
                        $sendMessage .= "\n> Dessert(s):\n";
                    }
                } elseif ($aliment === 5) {
                    if ($key === 1) {
                        $sendMessage .= "\n> Viande(s):\n";
                    } elseif ($key === 2) {
                        $sendMessage .= "\n> Légume(s) / Féculent(s):\n";
                    } elseif ($key === 3) {
                        $sendMessage .= "\n> Fromage(s):\n";
                    } elseif ($key === 4) {
                        $sendMessage .= "\n> Dessert(s):\n";
                    }
                }
                foreach ($value as $key => $value) {
                    if ($key > 0) {
                        $sendMessage .= "\t*ou*\n";
                    }
                    $sendMessage .= "\t\t__" . ucfirst(strtolower(trim($value['name'], ' '))) . "__";
                    foreach ($value['labels'] as $value) {
                        if ($value['name'] == "Fait maison - Recette du chef") {
                            $sendMessage .= " <:FAITMAISON:778334643480297494>";
                        } elseif ($value['name'] == "Issu de l'Agriculture Biologique") {
                            $sendMessage .= " <:Bio:778327312549806080>";
                        } elseif ($value['name'] == "Assemblé sur place") {
                            $sendMessage .= " <:assemble_sur_place:778413211887992854>";
                        }
                    }
                    $sendMessage .= "\n";
                }
            }
        }

        $sendMessage .= "\nBon Appétit! 🍽";

        return $sendMessage;
    }
}