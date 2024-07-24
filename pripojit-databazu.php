<?php
// konfigurácia prístupov do DB:
    require __DIR__ . '/config/db.php';

    // pripojenie na databázu
    
    try {
        $__db = new PDO(DB_DSN, DB_USER, DB_PASS, $pdoOptions);
    } catch (PDOException $e) {
        echo 'Nepodarilo sa pripojit k databaze.';
        exit;
        // echo $e->getMessage() . '<br>';
        // echo $e->getCode() . '<br>';
    }