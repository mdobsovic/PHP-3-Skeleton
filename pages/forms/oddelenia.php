<form method="post" action="index.php?page=oddelenia-save" class="form-horizontal">
    <?php if (!empty($oddelenie['id'])) { ?>
        <h1>Upraviť oddelenie <?= $oddelenie['nazov']; ?></h1>
        <input type="hidden" name="id" value="<?= $oddelenie['id']; ?>">
    <?php } else { ?>
        <h1>Vytvoriť nové oddelenie</h1>
    <?php } ?>

    <div class="form-group">
        <label class="control-label col-md-4" for="nazo">Názov:</label>
        <div class="col-md-4">
            <input type="text" id="nazo" name="nazo" class="form-control" value="<?= $oddelenie['nazov']; ?>">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-md-4" for="veduci">Vedúci:</label>
        <div class="col-md-4">
            <select id="veduci" name="veduci" class="form-control">
                <option value="">vyberte zamestnanca</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-4 col-md-offset-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="glyphicon glyphicon-ok"></i>
                Uložiť zmeny
            </button>
            <a href="index.php?page=oddelenia" class="btn btn-danger">
                <i class="glyphicon glyphicon-remove"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>