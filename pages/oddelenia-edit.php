<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // načítať dáta z databázy
    // dotaz na vyber konkretneho oddelenia
    $query = 'SELECT * FROM oddelenia WHERE id = :id;';

    $odd = $__db->prepare($query);  // pripravim dotaz
    $odd->execute(['id' => $id]);   // spustim dotaz
    $oddelenie = $odd->fetch();     // nacitam jeden riadok (dotaz moze vratit bud 0 riadkov alebo 1 riadok)

    // ak oddelenie so zadanym id neexistuje,
    if ($oddelenie === false) {
        // vypisem chybu:
        $hlasenia[] = [
            'typ' => 'danger',
            'text' => 'Oddelenie so zadaným ID neexistuje.',
            'ikona' => 'exclamation-triangle',
        ];
        return; // ukonci iba tento subor a pokracuje tam, kde bol tento subor includnuty (v nasom pripade index.php:23)
    }

    require __DIR__ . '/forms/oddelenia.php';