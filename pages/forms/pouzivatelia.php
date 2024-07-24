<form method="post" action="/pouzivatelia-save.php" class="form-horizontal">
    <?php if (isset($pouzivatel['id'])) { ?>
        <h1>Upraviť používateľa <?= $pouzivatel['meno']; ?> <?= $pouzivatel['priezvisko']; ?></h1>
        <input type="hidden" name="id" value="<?= $pouzivatel['id']; ?>">
    <?php } else { ?>
        <h1>Vytvoriť nového používateľa</h1>
    <?php } ?>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="meno">Meno:</label>
        <div class="col-md-4">
            <input type="text" id="meno" name="meno" class="form-control" value="<?= $pouzivatel['meno'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="priezvisko">Priezvisko:</label>
        <div class="col-md-4">
            <input type="text" id="priezvisko" name="priezvisko" class="form-control" value="<?= $pouzivatel['priezvisko'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="username">Prihlasovacie meno:</label>
        <div class="col-md-4">
            <input type="text" id="username" name="username" class="form-control" value="<?= $pouzivatel['username'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="email">E-mail:</label>
        <div class="col-md-4">
            <input type="text" id="email" name="email" class="form-control" value="<?= $pouzivatel['email'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-4 offset-md-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i>
                Uložiť zmeny
            </button>

            <a href="/?page=pouzivatelia" class="btn btn-danger">
                <i class="bi bi-x-circle"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>