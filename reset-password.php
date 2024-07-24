<?php
session_start();
require __DIR__ . '/pripojit-databazu.php';

// nacitam si ID poslane z formulara:
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

// zistim, ci pouzivatel so zadanym ID existuje:
// .......

// vygenerujem nahodne heslo pre pouzivatela:
require __DIR__ . '/funkcie.php';
$heslo = generujHeslo(); // tato funkcia sa nachadza v subore funkcie.php

// teraz v premennej $heslo mam plaintext verziu hesla
// ulozim si ju do session, aby som ho neskor mohol zobrazit na obrazovke
$_SESSION['heslo_plain'] = $heslo;
// heslo prezeniem cez hashovaciu funkciu, pretoze hash hesla budem ukladat do databazy:
$heslo = password_hash($heslo, PASSWORD_BCRYPT);

$query = 'UPDATE users SET heslo = :heslo WHERE id = :id;';
$zmenaHesla = $__db->prepare($query);
try {
    $zmenaHesla->execute(['heslo' => $heslo, 'id' => $id]);
    header('Location: /?page=pouzivatelia&reset');
} catch (Exception $e) {
    echo 'Chyba: ' . $e->getMessage(); // chybu nebudem vypisovat v produkcnej verzii!!!!
    exit;
}