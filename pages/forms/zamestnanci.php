<form method="post" action="/zamestnanci-save.php" class="form-horizontal">
    <?php if (isset($zamestnanec['id'])) { ?>
        <h1>Upraviť zamestnanca <?= $zamestnanec['meno']; ?> <?= $zamestnanec['priezvisko']; ?></h1>
        <input type="hidden" name="id" value="<?= $zamestnanec['id']; ?>">
    <?php } else { ?>
        <h1>Vytvoriť nového zamestnanca</h1>
    <?php } ?>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="meno">Meno:</label>
        <div class="col-md-4">
            <input type="text" id="meno" name="meno" class="form-control" value="<?= $zamestnanec['meno'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="priezvisko">Priezvisko:</label>
        <div class="col-md-4">
            <input type="text" id="priezvisko" name="priezvisko" class="form-control" value="<?= $zamestnanec['priezvisko'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="telefon">Telefón:</label>
        <div class="col-md-4">
            <input type="text" id="telefon" name="telefon" class="form-control" value="<?= $zamestnanec['telefon'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="email">E-mail:</label>
        <div class="col-md-4">
            <input type="text" id="email" name="email" class="form-control" value="<?= $zamestnanec['email'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="oddelenie">Oddelenie:</label>
        <div class="col-md-4">
            <select id="oddelenie" name="oddelenie" class="form-select">
                <option value="">vyberte oddelenie</option>
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-4 offset-md-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i>
                Uložiť zmeny
            </button>

            <a href="/?page=zamestnanci" class="btn btn-danger">
                <i class="bi bi-x-circle"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>