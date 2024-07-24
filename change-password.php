<?php
session_start();

// overim, ci je pouzivatel prihlaseny
// ak nie, presmerujem ho na uvodnu stranku:
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}

// nacitam hodnoty z formulara:
$aktualne = filter_input(INPUT_POST, 'aktualne');
$nove = filter_input(INPUT_POST, 'nove');
$potvrdenie = filter_input(INPUT_POST, 'potvrdenie');

require __DIR__ . '/pripojit-databazu.php';

// overim, ci bolo zadane spravne aktualne heslo
$query = 'SELECT heslo FROM users WHERE id = :id;';
$heslo = $__db->prepare($query);
$heslo->execute(['id' => $_SESSION['user']['id']]);
$riadok = $heslo->fetch();
if (!$riadok) {
    header('Location: /');
    exit;
}
$aktualneHeslo = $riadok['heslo']; // hash aktualneho hesla nacitany z databazy
if (!password_verify($aktualne, $aktualneHeslo)) { // ak zadane aktualne heslo nie je spravne
    header('Location: /?page=zmenit-heslo&err=1'); // vratim sa na formular s chybou c. 1
    exit;
}

if ($nove !== $potvrdenie) { // ak sa nove heslo nezhoduje s potvrdenim hesla
    header('Location: /?page=zmenit-heslo&err=4'); // vratim sa na formular s chybou c. 4
    exit;
}

// overim, ci nove heslo vyhovuje podmienkam:
// ma min. 8 znakov
// obsahuje aspon 1 velke pismeno
// obsahuje aspon 1 male pismeno
// obsahuje aspon 1 cislicu
if (mb_strlen($nove) < 8) { // ak ma nove heslo menej ako 8 znakov
    header('Location: /?page=zmenit-heslo&err=2'); // vratim sa na formular s chybou c. 2
    exit;
}

if (preg_match('/[A-Z]/', $nove) !== 1) { // ak heslo neobsahuje aspon 1 velke pismeno
    header('Location: /?page=zmenit-heslo&err=3'); // vratim sa na formular s chybou c. 3
    exit;
}

if (preg_match('/[a-z]/', $nove) !== 1) { // ak heslo neobsahuje aspon 1 male pismeno
    header('Location: /?page=zmenit-heslo&err=3'); // vratim sa na formular s chybou c. 3
    exit;
}

if (preg_match('/[0-9]/', $nove) !== 1) { // ak heslo neobsahuje aspon 1 cislicu
    header('Location: /?page=zmenit-heslo&err=3'); // vratim sa na formular s chybou c. 3
    exit;
}

// vygenerujem hash hesla a ulozim ho do databazy
$hash = password_hash($nove, PASSWORD_BCRYPT);
$query = 'UPDATE users SET heslo = :heslo WHERE id = :id;';
$zmena = $__db->prepare($query);
try {
    $zmena->execute(['heslo' => $hash, 'id' => $_SESSION['user']['id']]);
    // presmerujem na uvodnu stranku s hlasenim, ze heslo bolo uspesne zmenene
    header('Location: /?change-password');
} catch (Exception $e) {
    echo 'Pri pokuse o zmenu hesla nastala chyba.';
}
