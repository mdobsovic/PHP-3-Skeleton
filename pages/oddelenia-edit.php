<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // načítať dáta z databázy
    $oddelenie = [
        'id' => $id,
        'nazov' => 'Personálne oddelenie',
        'veduci' => 1,
    ];

    require __DIR__ . '/forms/oddelenia.php';