<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // načítať dáta z databázy
    $zamestnanec = [
        'id' => $id,
        'meno' => 'Peter',
        'priezvisko' => 'Novák',
        'telefon' => '02/4920 3080',
        'email' => 'novak@itlearning.sk',
        'oddelenie' => 1,
    ];

    require __DIR__ . '/forms/zamestnanci.php';