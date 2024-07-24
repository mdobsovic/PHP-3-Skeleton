<form method="post" action="/oddelenia-save.php" class="form-horizontal">
    <?php if (isset($oddelenie['id'])) { ?>
        <h1>Upraviť oddelenie <?= $oddelenie['nazov']; ?></h1>
        <input type="hidden" name="id" value="<?= $oddelenie['id']; ?>">
    <?php } else { ?>
        <h1>Vytvoriť nové oddelenie</h1>
    <?php } ?>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="nazov">Názov:</label>
        <div class="col-md-4">
            <input type="text" id="nazov" name="nazov" class="form-control" value="<?= $oddelenie['nazov'] ?? ''; ?>">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="veduci">Vedúci:</label>
        <div class="col-md-4">
            <select id="veduci" name="veduci" class="form-select">
                <option value="">vyberte zamestnanca</option>
            </select>
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-4 offset-md-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i>
                Uložiť zmeny
            </button>
            <a href="/?page=oddelenia" class="btn btn-danger">
                <i class="bi bi-x-circle"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>