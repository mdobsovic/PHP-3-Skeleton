<?php

// tento subor sa v ziadnom pripade nesmie nachadzat v produkcnom GIT repozitari!
// vid subor .gitignore

// mysql: - ovladac, ktory bude PDO pouzivat, zvysok pripajacieho retazca zavisi od ovladaca
// napr. ak by som mal sqlsrv: tak zvysok retazca je uplne iny
// host - nazov alebo IP adresa servera, kam sa pripajam, 127.0.0.1 znamena moj lokalny pocitac
// port - port servera, default je 3306, nemusi byt vyplneny
// dbname - nazov databazy na serveri
// charset - nastavim utf8, pretoze take mam aj collation v databaze
define('DB_DSN', 'mysql:host=127.0.0.1;port=3306;dbname=php3;charset=utf8');
// konstanta, kt. obsahuje prihlasovacie meno k serveru
define('DB_USER', 'php3');
// konstanta, kt. obsahuje heslo k serveru pre pouzivatela php3
define('DB_PASS', 'Password.123');
// reset hesla v databaze sa robi napr. cez phpMyAdmin:
// Home --> User Accounts --> vybrat konto --> Change password
// alebo SQL prikazom: ALTER USER 'php3'@'localhost' IDENTIFIED BY 'New-Password-Here';

$pdoOptions = [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // PDO bude vracat asociativne pole
    // stlpec nazov ziskam iba ako $riadok['nazov'], stlpec cena ziskam ako $riadok['cena'], ...
    // PDO::FETCH_OBJ by znamenalo, ze riadky sa vracaju ako objekty
    // stlpec nazov ziskam ako $riadok->nazov, stlpce cena ziskam ako $riadok->cena, ...
];