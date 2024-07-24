<?php
session_start();
require __DIR__ . '/pripojit-databazu.php';

// implementovať ukladanie do databázy

// 1. načítam údaje, ktoré mi prišli z formulára (metóda POST)
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$meno = filter_input(INPUT_POST, 'meno');
$priezvisko = filter_input(INPUT_POST, 'priezvisko');
$telefon = filter_input(INPUT_POST, 'telefon', FILTER_SANITIZE_NUMBER_INT); // filter povoli iba cislice 0-9 a znaky + a -
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$oddelenie = filter_input(INPUT_POST, 'oddelenie', FILTER_SANITIZE_NUMBER_INT);

// 2. overím, či údaje majú zmysel
if (!empty($id)) { // overujem iba, ak menim existujuceho zamestnanca, nie ak pridavam noveho
    // id musi byt kladne cislo, ktore existuje v tabulke zamestnanci v stlpci id
    // riesenie: zistim, ci existuje v tabulke zamestnanci zaznam so zadanym id:
    $query = 'SELECT 1 FROM zamestnanci WHERE id = :id;';
    $existuje = $__db->prepare($query);
    $existuje->execute(['id' => $id]);
    if ($existuje->fetch() === false) {
        $_SESSION['hlasky'][] = [
            'typ' => 'danger',
            'text' => 'Zamestnanec so zadaným ID neexistuje.',
            'ikona' => 'exclamation-triangle'
        ];
        header('Location: /?page=zamestnanci');
        exit;
    }
}
// meno moze obsahovat iba pismena, medzery, bodku a pomlcku
// \p{L} - reprezentuje pismena aj s diakritikou
// https://www.php.net/manual/en/reference.pcre.pattern.syntax.php
if (preg_match('/[^\p{L} .-]/u', $meno) === 1) {
    $_SESSION['hlasky'][] = [
        'typ' => 'danger',
        'text' => 'Meno obsahuje nepovolené znaky.',
        'ikona' => 'exclamation-triangle'
    ];
    header('Location: /?page=zamestnanci');
    exit;
}
// priezvisko moze obsahovat iba pismena, medzery, bodku a pomlcku
if (preg_match('/[^\p{L} .-]/u', $priezvisko) === 1) {
    $_SESSION['hlasky'][] = [
        'typ' => 'danger',
        'text' => 'Priezvisko obsahuje nepovolené znaky.',
        'ikona' => 'exclamation-triangle'
    ];
    header('Location: /?page=zamestnanci');
    exit;
}
// telefon nemusi byt vyplneny, ale ak je, musi mat minimalne 6 znakov
if (!empty($telefon) && mb_strlen(trim($telefon)) < 6) {
    $_SESSION['hlasky'][] = [
        'typ' => 'danger',
        'text' => 'Telefónne číslo musí mať minimálne 6 znakov.',
        'ikona' => 'exclamation-triangle'
    ];
    header('Location: /?page=zamestnanci');
    exit;
}

// e-mail musi mat minimalne 6 znakov (x@x.sk) a musi byt v tvare nieco @ nieco . domena
    // nieco = minimalne jeden znak z mnoziny: pismena, cislice, pomlcka, bodka
    // domena = minimalne 2 znaky z mnoziny: pismena

    // Regularny vyraz - Regular Expression
    // https://regex101.com/
    $emailPattern = '/^(?!.*\.\.)(?!.*--)[a-z0-9]+(?:[a-z0-9.-]*[a-z0-9])?@[a-z0-9]+(?:[a-z0-9.-]*[a-z0-9])?\.[a-z]{2,}$/';
/*
    Vysvetlenie regulárneho výrazu:
    ^: začiatok reťazca

    (?!.*\.\.): uistíme sa, že reťazec neobsahuje dve bodky za sebou.
    (?!.*--): uistíme sa, že reťazec neobsahuje dve pomlčky za sebou.
    Kombinácia ?! v regulárnom výraze označuje tzv. negatívny lookahead.
    Tento výraz hovorí, že niečo nesmie nasledovať po danom vzore. Inými slovami, ?! zabezpečuje, 
    že určitý podreťazec sa nenachádza na špecifickom mieste v texte.
    V našom prípade sme použili negatívny lookahead, aby sme zabezpečili, 
    že e-mailová adresa neobsahuje dve bodky alebo dve pomlčky za sebou.

    [a-z0-9]+: začiatočný znak musí byť malé písmeno alebo číslica.
    (?:[a-z0-9.-]*[a-z0-9])?: nasledované voliteľným reťazcom, ktorý obsahuje malé písmená, číslice, bodky alebo pomlčky, ale nesmie končiť bodkou alebo pomlčkou.
    @[a-z0-9]+: znak @ nasledovaný jedným alebo viacerými malými písmenami alebo číslicami.
    (?:[a-z0-9.-]*[a-z0-9])?: následné voliteľné znaky, ktoré môžu obsahovať malé písmená, číslice, bodky alebo pomlčky, ale nesmú končiť bodkou alebo pomlčkou.
    \.[a-z]{2,}$: musí končiť bodkou a dvoma alebo viacerými malými písmenami.
*/

    $isValidEmailAddress = preg_match($emailPattern, mb_strtolower($email)) === 1;
if (mb_strlen($email) < 6 || !$isValidEmailAddress) {
    $_SESSION['hlasky'][] = [
        'typ' => 'danger',
        'text' => 'E-mailová adresa je nesprávna.',
        'ikona' => 'exclamation-triangle'
    ];
    header('Location: /?page=zamestnanci');
    exit;
}

// oddelenie nemusi byt vyplnene, ale ak je, musi to byt kladne cislo, ktore existuje v tabulke oddelenia v stlpci id
    // o toto sa starat vobec nemusim, pretoze v databaze som urobil foreign key a ten sa o to postara automaticky.

// ak je zamestnanec veducim nejakeho oddelenia, tak v premennej $oddelenie musi byt toto oddelenie a ziadne ine
$query = 'SELECT id FROM oddelenia WHERE veduci = :id;';
$veduci = $__db->prepare($query);
$veduci->execute(['id' => $id]);
$veduciOddelenia = $veduci->fetch();
if ($veduciOddelenia && (string) $veduciOddelenia['id'] !== $oddelenie) {
    $_SESSION['hlasky'][] = [
        'typ' => 'danger',
        'text' => 'Vedúci oddelenia nesmie byť priradený v inom oddelení.',
        'ikona' => 'exclamation-triangle'
    ];
    header('Location: /?page=zamestnanci');
    exit;
}

// 3. vložím zamestnanca do databázy alebo upravím zamestnanca v databáze
    // 3.0. rozhodnem sa, či vkladám alebo upravujem - podľa toho, či mi prišiel parameter 'id'
        // ak prišiel parameter 'id', tak upravujem existujúceho zamestnanca
        // ak neprišiel parameter 'id', tak pridávam nového
    // 3.1. napíšem $query
    if (!empty($id)) {
        // mam nejake id, takze upravujem existujuceho zamestnanca
        $query = 'UPDATE zamestnanci SET 
            meno = :meno, priezvisko = :priezvisko, 
            telefon = :telefon, email = :email, oddelenie = :oddelenie
            WHERE id = :id;';
    } else {
        // nemam id, takze pridavam noveho zamestnanca
        $query = 'INSERT INTO zamestnanci (meno, priezvisko, telefon, email, oddelenie)
        VALUES (:meno, :priezvisko, :telefon, :email, :oddelenie);';
    }
    
    // 3.3. pripravím dotaz
    $save = $__db->prepare($query);

    // 3.4. spustím dotaz a overím, či sa podarilo
    try {
        $data = [
            'meno' => $meno,
            'priezvisko' => $priezvisko,
            'telefon' => !empty($telefon) ? $telefon : null,
            'email' => $email,
            'oddelenie' => !empty($oddelenie) ? $oddelenie : null,
        ];
        
        // ak menim existujuceho zamestnanca, mam vyplnene id a vlozim si ho do $data,
        // aby som ho mohol pouzit v prikaze UPDATE
        if (!empty($id)) {
            $data['id'] = $id;
        }

        $save->execute($data);
    } catch (Exception $e) {
        echo 'Nastala chyba: ' . $e->getMessage();
        exit;
    }

    // 3.5. vrátim sa na stránku so zoznamom zamestnancov
    header('Location: /?page=zamestnanci');