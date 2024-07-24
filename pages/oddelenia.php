<?php
    // CASE WHEN podmienka THEN hodnota, ktora sa vrati, ak podmienka plati
    //      WHEN podmienka2 THEN hodnota 2...
    // END AS nazov_stlpca, pod ktorym sa hodnota vrati

    // CONCAT('string1', 'string2', 'string3', ..., 'stringN') - spoji vsetky retazce dokopy do jedneho
    // LEFT(veduci.meno, 1) - vrati 1 znak z lavej strany z hodnoty veduci.meno
    // CONCAT(LEFT(veduci.meno, 1), '. ', veduci.priezvisko) - urobi M. Priezvisko
    // kedze v SQL dotaze chcem vypisat znak ', musim ho pre PHP zaescapeovat pomocou \
    // alebo by som mohol cely dotaz nedat do ' ale do "

    // v nasom pripade pomocou CASE WHEN veduci.id IS NOT NULL zistujeme, ci oddelenie ma veduceho
    // ak ma, potom je tato hodnota urcite vyplnena, pretoze id pri veducom (tabulka zamestnanci) je primarny kluc,
    // a teda nesmie mat hodnotu NULL. ak oddelenie nema veduceho, potom prikaz LEFT JOIN vrati do vsetkych stlpcov
    // v tabulke veduci hodnoty NULL, teda aj do veduci.id. Ak by podmienka "veduci.id IS NOT NULL" neplatila, potom
    // nema zmysel pocitat hodnotu M. Priezvisko pri veducom, pretoze oddelenie nema veduceho.
    // Ak by pri CASE neplatila ani jedna podmienka, vrati sa to, co je vo vetve ELSE, kedze nemame ani vetvu ELSE
    // v prikaze CASE, tak sa vrati hodnota NULL.

    // COUNT(z.id) vrati pocet riadkov pre dane oddelenie, kde hodnota z.id nie je NULL
    // aby som dostal spravne vysledky, musim este data zoskupit a to podla tych stlpcov,
    // ktore vypisujem (su v klauzule SELECT) a zaroven nie su sucastou agregacnej funkcie (COUNT, SUM, AVG, MIN, MAX)
    $query = 'SELECT
        o.id, o.nazov,
        CASE 
            WHEN veduci.id IS NOT NULL THEN CONCAT(LEFT(veduci.meno, 1), \'. \', veduci.priezvisko)
        END AS veduci,
        COUNT(z.id) AS pocet_zamestnancov
    FROM oddelenia AS o
    LEFT JOIN zamestnanci AS veduci ON o.veduci = veduci.id
    LEFT JOIN zamestnanci AS z ON z.oddelenie = o.id
    GROUP BY o.id, o.nazov, veduci
    ;';

    $oddelenia = $__db->prepare($query);
    $oddelenia->execute();
?>
<h1>Oddelenia</h1>
<a href="index.php?page=oddelenia-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať oddelenie
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
    <thead>
        <tr>
            <th>Názov</th>
            <th>Vedúci</th>
            <th>Počet zamestnacov</th>
            <th>Možnosti</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($oddelenia->fetchAll() as $odd) { ?>
            <tr>
                <td><?= $odd['nazov']; ?></td>
                <td><?= $odd['veduci'] ?? '<span class="badge text-bg-danger">oddelenie nemá vedúceho</span>'; ?></td>
                <td>
                    <span class="badge text-bg-secondary"><?= $odd['pocet_zamestnancov']; ?></span>
                </td>
                <td>
                    <a href="/?page=oddelenia-edit&id=<?= $odd['id']; ?>" class="btn btn-primary btn-sm" title="Upraviť">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm oddelenia-delete" data-id="<?= $odd['id']; ?>" title="Zmazať">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>