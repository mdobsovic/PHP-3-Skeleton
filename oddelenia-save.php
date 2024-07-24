<?php

// implementovať ukladanie do databázy

// 1. načítam údaje, ktoré mi prišli z formulára (metóda POST)
$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
$nazov = filter_input(INPUT_POST, 'nazov');
$veduci = filter_input(INPUT_POST, 'veduci', FILTER_SANITIZE_NUMBER_INT);

// 2. overím, či údaje majú zmysel
// id musi byt kladne cislo, ktore existuje v tabulke oddelenia v stlpci id
// nazov moze obsahovat iba pismena, medzery, pomlcku a bodku
// veduci nemusi byt vyplneny, ale ak je, musi to byt kladne cislo, ktore existuje v tabulke zamestnanci v stlpci id
    // o toto sa starat vobec nemusim, pretoze v databaze som urobil foreign key a ten sa o to postara automaticky.

// 3. vložím oddelenie do databázy alebo upravím oddelenie v databáze
    // 3.0. rozhodnem sa, či vkladám alebo upravujem - podľa toho, či mi prišiel parameter 'id'
        // ak prišiel parameter 'id', tak upravujem existujúce oddelenie
        // ak neprišiel parameter 'id', tak pridávam nové
    // 3.1. napíšem $query
    if (!empty($id)) {
        // mam nejake id, takze upravujem existujuce oddelenie
        $query = 'UPDATE oddelenia SET nazov = :nazov, veduci = :veduci WHERE id = :id;';
    } else {
        // nemam id, takze pridavam nove oddelenie
        $query = 'INSERT INTO oddelenia (nazov, veduci) VALUES (:nazov, :veduci);';
    }
    // 3.2. pripojím sa k databáze
    require __DIR__ . '/pripojit-databazu.php';

    // 3.3. pripravím dotaz
    $save = $__db->prepare($query);

    // 3.4. spustím dotaz a overím, či sa podarilo
    try {
        $data = [
            'nazov' => $nazov,
            'veduci' => !empty($veduci) ? $veduci : null,
        ];
        
        // ak menim existujuce oddelenie, mam vyplnene id a vlozim si ho do $data,
        // aby som ho mohol pouzit v prikaze UPDATE
        if (!empty($id)) {
            $data['id'] = $id;
        }

        $save->execute($data);
    } catch (Exception $e) {
        echo 'Nastala chyba: ' . $e->getMessage();
        exit;
    }

    // 3.5. vrátim sa na stránku so zoznamom oddeleni
    header('Location: /?page=oddelenia');