<?php
    if (isset($_GET['change-password'])) {
        $hlasenia[] = [
            'typ' => 'success',
            'text' => 'Vaše heslo bolo zmenené.',
            'ikona' => 'check-circle',
        ];
    }
?>
<h1>Úvodná stránka</h1>
<?php

// tento zapis nebudeme uz nikdy pouzivat: $id = $_GET['id'];
// preco?
// 1. neoveril som, ci parameter id skutocne cez GET prichadza
    // mozem vyriesit pridanim isset($_GET['id'])
        // if (isset($_GET['id'])) {
        //     $id = $_GET['id'];
        // } else {
        //     $id = 1;
        // }
    // kratsi zapis:
        // $id = isset($_GET['id']) ? $_GET['id'] : 1; // ternary operator
    // este kratsi zapis:
        // $id = $_GET['id'] ?? 1; // null coalescing operator
// 2. viem, ze v parametri id mam mat iba cislo, teda musim odstranit vsetky znaky, ktore nie su cisla:
        // $id = preg_replace('/[^0-9]/', '', $id);
    
// funkcia filter_input ma 2 alebo 3 parametre
// prvy parameter: INPUT_GET, INPUT_POST, INPUT_COOKIE, INPUT_ENV, ...  
    // ekvivalent: $_GET = INPUT_GET, $_POST = INPUT_POST
// druhy parameter: nazov hodnoty
    // ak som mal $_GET['id'], tak bude filter_input(INPUT_GET, 'id')
    // ak som mal $_POST['nazov']), tak bude filter_input(INPUT_POST, 'nazov')
// filter_input vrati do premennej hodnotu parametra. ak parameter neexistuje, filter_input nevrati chybu,
// ale vrati hodnotu null
// ak by som chcel default hodnotu, mozem pouzit null coalescing operator
// treti parameter funkcie filter_input umozni urobit filter:
        // FILTER_SANITIZE_NUMBER_INT = ponecha iba cislice a znaky + a -
        // FILTER_SANITIZE_NUMBER_FLOAT = ponecha iba cislice a znaky . + a -
        // ak by som chcel aj ciarku, mozem dopisat stvrty parameter FILTER_FLAG_ALLOW_THOUSAND
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT) ?? 1;
// ak by som hodnotu uz mal v nejakej premennej, tak mozem pouzit namiesto filter_input funkciu filter_var

// SELECT * pouzivam iba v pripade, ze naozaj chcem vybrat vsetky stlpce z tabulky
// ak nie, tak by som pouzil tvar SELECT id, nazov FROM ovocie;
    // $query = 'SELECT * FROM ovocie WHERE id = ' . $id . ';';
    $query = 'SELECT * FROM ovocie WHERE id = ?;';
    echo '<pre>' . $query . '</pre>';

    // SELECT * FROM ovocie WHERE id = 1; UPDATE ovocie SET nazov='kukurica' WHERE id=1;

    // premenna ovocie obsahuje instaciu triedy PDOStatement, zatial nie samotne data
    // nebudem pouzivat iba metody query:
    // $ovocie = $__db->query($query);
    // pouzijem prepare - execute
    $ovocie = $__db->prepare($query);
    $ovocie->execute([$id]);


    // data sa nacitaju pomocou metody fetch() - jeden riadok alebo fetchAll() - vsetky riadky
    // a dalej budeme pracovat systemom "riadok po riadku"

    /*
    echo '<pre>';
    foreach ($ovocie->fetchAll() as $riadok) {
        var_dump($riadok);
    }
    echo '</pre>';
    */

    /* mohol by som pouzit aj nieco taketo:
    while ($riadok = $ovocie->fetch()) { ... }
    */


    // ukazka, ak by som mal multijazycnu stranku:
    // if (filter_input(INPUT_GET, 'lang') === 'en') {
    //     $vypis = 'Fruit with number %d has name of %s.<br>';
    // } else {
    //     $vypis = 'Ovocie s cislom %d sa vola %s.<br>';
    // }

    foreach ($ovocie->fetchAll() as $riadok) {
        echo 'Ovocie s cislom ' . $riadok['id'] . ' sa vola ' . $riadok['nazov'] . '.<br>';
        // // ukazka, ak by som mal multijazycnu stranku:
        // echo sprintf($vypis, $riadok['id'], $riadok['nazov']);
    }