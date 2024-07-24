<?php
    header('Content-Type: text/json');

    require __DIR__ . '/pripojit-databazu.php';

    switch (filter_input(INPUT_GET, 'action')) {
        case 'zamestnanci-delete':
            // nacitam ID z GET parametru
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

            // vytvorim dotaz pre databazu
            $query = 'DELETE FROM zamestnanci WHERE id = :id;';

            // pripravim dotaz
            $delete = $__db->prepare($query);

            // skusim spustit dotaz, ak zbehol, tak vratim OK
            try {
                $delete->execute(['id' => $id]);
                echo json_encode(['status' => 'OK']);
            } catch (Exception $e) {
            // ak nezbehol, vratim chybovu hlasku
            // v produkcnom prostredi nikdy pouzivatelovi nevypisujte $e->getMessage(), pretoze
            // moze obsahovat citlive udaje, ktore navstevnikovi vasej stranky rozhodne nechcete ukazat
            // namiesto toho mu vypiste nejaku hlasku typu "Zamestnanca nebolo mozne vymazat" a samotne
            // $e->getMessage() si ulozte do nejakeho logu, poslite si to mailom, atd.
                echo json_encode(['status' => 'Nastala chyba: ' . $e->getMessage()]);
                // do suboru chyby.log prida na koniec (FILE_APPEND)
                // hodnotu: Datum: 20240724142350;Chyba: Chybova hlaska z databazy
                // file_put_contents(__DIR__ . '/chyby.log', 'Datum: ' . date('YmdHis') . ';Chyba: ' . $e->getMessage() . "\n", FILE_APPEND);
            }
            break;
        case 'oddelenia-delete':
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $query = 'DELETE FROM oddelenia WHERE id = :id;';
            $delete = $__db->prepare($query);
            try {
                $delete->execute(['id' => $id]);
                echo json_encode(['status' => 'OK']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'Nastala chyba: ' . $e->getMessage()]);
            }
            break;
        case 'pouzivatelia-delete':
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $query = 'DELETE FROM users WHERE id = :id;';
            $delete = $__db->prepare($query);
            try {
                $delete->execute(['id' => $id]);
                echo json_encode(['status' => 'OK']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'Nastala chyba: ' . $e->getMessage()]);
            }
            break;
    }

    // tu uz nesmie byt nic!
    // ak by bolo, zlyhalo by spracovanie JSON hodnoty v JavaScripte