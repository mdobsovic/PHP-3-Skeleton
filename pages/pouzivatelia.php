<?php
    $query = 'SELECT id, meno, priezvisko, username, email FROM users;';
    $users = $__db->prepare($query);
    $users->execute();

    // ak som vytvoril noveho pouzivatela a $_SESSION['heslo_plain'] existuje, vypisem hodnotu
    // noveho hesla:
    if (isset($_SESSION['heslo_plain'])) {
        $hlasenia[] = [
            'typ' => 'info',
            'text' => (isset($_GET['reset']) ? 'Nové heslo je: ' : 'Bol vytvorený nový používateľ, jeho heslo je: ') . $_SESSION['heslo_plain'],
            'ikona' => 'person-check',
        ];
        // zrusim session heslo_plain:
        unset($_SESSION['heslo_plain']);
    }

?>
<h1>Používatelia</h1>
<a href="index.php?page=pouzivatelia-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať používateľa
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
    <thead>
        <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Prihlasovacie meno</th>
            <th>E-mail</th>
            <th>Možnosti</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($users->fetchAll() as $user) { ?>
        <tr>
            <td><?= $user['meno']; ?></td>
            <td><?= $user['priezvisko']; ?></td>
            <td><?= $user['username']; ?></td>
            <td><?= $user['email']; ?></td>
            <td>
                <a href="/?page=pouzivatelia-edit&id=<?= $user['id']; ?>" class="btn btn-primary btn-sm" title="Upraviť">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="/?page=pouzivatelia-heslo&id=<?= $user['id']; ?>" class="btn btn-warning btn-sm" title="Resetovať heslo">
                    <i class="bi bi-key"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm pouzivatelia-delete" data-id="<?= $user['id']; ?>" title="Zmazať">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>