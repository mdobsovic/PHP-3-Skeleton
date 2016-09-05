<form method="post" action="index.php?page=zamestnanci-save" class="form-horizontal">
    <?php if (!empty($zamestnanec['id'])) { ?>
        <h1>Upraviť zamestnanca <?= $zamestnanec['meno']; ?> <?= $zamestnanec['priezvisko']; ?></h1>
        <input type="hidden" name="id" value="<?= $zamestnanec['id']; ?>">
    <?php } else { ?>
        <h1>Vytvoriť nového zamestnanca</h1>
    <?php } ?>

    <div class="form-group">
        <label class="control-label col-md-4" for="meno">Meno:</label>
        <div class="col-md-4">
            <input type="text" id="meno" name="meno" class="form-control" value="<?= $zamestnanec['meno']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="priezvisko">Priezvisko:</label>
        <div class="col-md-4">
            <input type="text" id="priezvisko" name="priezvisko" class="form-control" value="<?= $zamestnanec['priezvisko']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="telefon">Telefón:</label>
        <div class="col-md-4">
            <input type="text" id="telefon" name="telefon" class="form-control" value="<?= $zamestnanec['telefon']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="email">E-mail:</label>
        <div class="col-md-4">
            <input type="text" id="email" name="email" class="form-control" value="<?= $zamestnanec['email']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="oddelenie">Oddelenie:</label>
        <div class="col-md-4">
            <select id="oddelenie" name="oddelenie" class="form-control">
                <option value="">vyberte oddelenie</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-ok"></i>
                Uložiť zmeny
            </button>

            <a href="index.php?page=zamestnanci" class="btn btn-danger">
                <i class="glyphicon glyphicon-remove"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>