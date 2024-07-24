<?php
    $query = 'SELECT 
        z.id, z.meno, z.priezvisko, z.telefon, z.email,
        o.nazov AS oddelenie
    FROM zamestnanci AS z
    LEFT JOIN oddelenia AS o ON o.id = z.oddelenie;';
    $zamestnanci = $__db->prepare($query);
    $zamestnanci->execute();
?>
<h1>Zamestnanci</h1>
<a href="index.php?page=zamestnanci-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať zamestnanca
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
    <thead>
        <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Telefón</th>
            <th>E-mail</th>
            <th>Oddelenie</th>
            <th>Možnosti</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($zamestnanci->fetchAll() as $zam) { ?>
            <tr>
                <td><?= $zam['meno']; ?></td>
                <td><?= $zam['priezvisko']; ?></td>
                <td><?= $zam['telefon']; ?></td>
                <td><?= $zam['email']; ?></td>
                <td><?= $zam['oddelenie'] ?? '<span class="badge text-bg-danger">nevyplnené</span>'; ?></td>
                <td>
                    <a href="/?page=zamestnanci-edit&id=<?= $zam['id']; ?>" class="btn btn-primary btn-sm" title="Upraviť">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm zamestnanci-delete" data-id="<?= $zam['id']; ?>" title="Zmazať">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>