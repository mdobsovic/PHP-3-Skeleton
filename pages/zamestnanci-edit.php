<?php

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    // načítať dáta z databázy
    // dotaz na vyber konkretneho zamestnanca
    $query = 'SELECT * FROM zamestnanci WHERE id = :id;';

    $zam = $__db->prepare($query);  // pripravim dotaz
    $zam->execute(['id' => $id]);   // spustim dotaz
    $zamestnanec = $zam->fetch();   // nacitam jeden riadok (dotaz moze vratit bud 0 riadkov alebo 1 riadok)

    // ak zamestnanec so zadanym id neexistuje,
    if ($zamestnanec === false) {
        // vypisem chybu:
        $hlasenia[] = [
            'typ' => 'danger',
            'text' => 'Zamestnanec so zadaným ID neexistuje.',
            'ikona' => 'exclamation-triangle',
        ];
        return; // ukonci iba tento subor a pokracuje tam, kde bol tento subor includnuty (v nasom pripade index.php:23)
    }

    // vlozim formular na upravu zamestnanca
    require __DIR__ . '/forms/zamestnanci.php';