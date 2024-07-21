<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    /*
    $hlasenia[] = [
        'typ' => 'danger',
        'ikona' => 'bug',
        'text' => 'Používateľ sa nenašiel.',
    ];
    return;
    */
    
    // načítať dáta z databázy
    $pouzivatel = [
        'id' => $id,
        'meno' => 'Peter',
        'priezvisko' => 'Novák',
        'username' => 'peter.novak',
        'email' => 'novak@itlearning.sk',
    ];

    require __DIR__ . '/forms/pouzivatelia.php';