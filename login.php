<?php

    $username = filter_input(INPUT_POST, 'username');
    $heslo = filter_input(INPUT_POST, 'password');

    require __DIR__ . '/pripojit-databazu.php';

    $query = 'SELECT id, meno, priezvisko, heslo FROM users WHERE username = :username;';
    $user = $__db->prepare($query);
    $user->execute(['username' => $username]);

    $u = $user->fetch();

    if (!$u) { // ak je zadane zle meno pouzivatela:
        header('Location: /login-form.php?err');
        exit;
    }

    if (!password_verify($heslo, $u['heslo'])) { // ak je zadane zle heslo:
        header('Location: /login-form.php?err');
        exit;
    }

    // tu som si isty, ze bolo zadane spravne meno a spravne heslo.
    // nastartujem session:
    session_start();

    // do premennej $_SESSION['user'] vlozim informacie o pouzivatelovi:
        // z premennej $u odstranim hash hesla:
        unset($u['heslo']);
        // zvysok vlozim do session:
        $_SESSION['user'] = $u;
    
    // presmerujem na hlavnu stranku:
    header('Location: /');