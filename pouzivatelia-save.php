<?php
session_start();
require __DIR__ . '/pripojit-databazu.php';

// implementovať ukladanie do databázy

// 1. načítam údaje, ktoré mi prišli z formulára (metóda POST)
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$meno = filter_input(INPUT_POST, 'meno');
$priezvisko = filter_input(INPUT_POST, 'priezvisko');
$username = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

if (!empty($id)) {
    // mam nejake id, takze upravujem existujuceho pouzivatela
    $query = 'UPDATE users SET meno = :meno, priezvisko = :priezvisko, username = :username, email = :email WHERE id = :id;';
} else {
    // nemam id, takze pridavam noveho pouzivatela

    // vygenerujem heslo pre pouzivatela, ale iba v pripade, ze vytvaram noveho:
    require __DIR__ . '/funkcie.php';
    $heslo = generujHeslo(); // tato funkcia sa nachadza v subore funkcie.php

    // teraz v premennej $heslo mam plaintext verziu hesla
    // ulozim si ju do session, aby som ho neskor mohol zobrazit na obrazovke
    $_SESSION['heslo_plain'] = $heslo;
    // heslo prezeniem cez hashovaciu funkciu, pretoze hash hesla budem ukladat do databazy:
    $heslo = password_hash($heslo, PASSWORD_BCRYPT);

    $query = 'INSERT INTO users (meno, priezvisko, username, email, heslo)
    VALUES (:meno, :priezvisko, :username, :email, :heslo);';
}
    
    // pripravím dotaz
    $save = $__db->prepare($query);

    // spustím dotaz a overím, či sa podarilo
    try {
        $data = [
            'meno' => $meno,
            'priezvisko' => $priezvisko,
            'username' => $username,
            'email' => $email,
        ];
        
        // ak menim existujuceho pouzivatela, mam vyplnene id a vlozim si ho do $data,
        // aby som ho mohol pouzit v prikaze UPDATE
        if (!empty($id)) {
            $data['id'] = $id;
        } else {
            // ak pridavam noveho pouzivatela, do $data musim pridat aj heslo, aby som ho mohol vlozit do databazy
            $data['heslo'] = $heslo;
        }

        $save->execute($data);
    } catch (Exception $e) {
        echo 'Nastala chyba: ' . $e->getMessage();
        exit;
    }

    // vrátim sa na stránku so zoznamom pouzivatelov
    header('Location: /?page=pouzivatelia');