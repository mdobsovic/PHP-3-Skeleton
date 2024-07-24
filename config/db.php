<?php

// tento subor sa v ziadnom pripade nesmie nachadzat v produkcnom GIT repozitari!
// vid subor .gitignore

define('DB_DSN', 'mysql:host=127.0.0.1;port=3306;dbname=NAZOVDATABAZY;charset=utf8');
define('DB_USER', 'PRIHLASOVACIE_MENO');
define('DB_PASS', 'HESLO');

$pdoOptions = [

];