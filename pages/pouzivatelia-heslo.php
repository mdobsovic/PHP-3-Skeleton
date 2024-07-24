<?php
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    // nacitam pouzivatela z databazy, aby som:
    // - zistil, ci existuje
    // - ziskal udaje do vypisu (meno a priezvisko)

    $query = 'SELECT meno, priezvisko FROM users WHERE id = :id;';
    $user = $__db->prepare($query);
    $user->execute(['id' => $id]);

    $u = $user->fetch(); // vyberiem riadok z tabulky
    if (!$u) { // ak sa v tabulke riadok nenachadza = pouzivatel neexistuje
        $hlasenia[] = [
            'typ' => 'danger',
            'text' => 'Používateľ so zadaným ID neexistuje.',
            'ikona' => 'exclamation-triangle',
        ];
        return;
    }
?>
<form method="post" action="/reset-password.php">
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="p-3 my-4 bg-body-tertiary rounded-2">
        <h3>Naozaj chcete resetovať heslo používateľa <?= $u['meno']; ?> <?= $u['priezvisko']; ?>?</h3>
        <div class="text-center">
            <button type="submit" class="btn btn-success">Áno, resetovať heslo!</button>
            <a href="/?page=pouzivatelia" class="btn btn-danger">Nie</a>
        </div>
    </div>
</form>