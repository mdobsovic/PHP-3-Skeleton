<?php
    // tento dotaz mi nacita zoznam zamestnancov pre roletku Veduci
    // nepotrebujem ziskavat vsetky udaje (napr. telefon, e-mail a oddelenie)
    // potrebujem iba id, meno a priezvisko, zamestnancov chcem vypisat abecedne podla priezviska,
    // preto dotaz bude vyzerat nasledovne:
    $query = 'SELECT id, meno, priezvisko FROM zamestnanci ORDER BY priezvisko;';
    $zamestnanci = $__db->prepare($query);
    $zamestnanci->execute();
?>
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
                <?php foreach ($zamestnanci->fetchAll() as $zam) { 
                    // <option value="1">Peter Novak</option>
                    // <option value="2">Jan Vesely</option>
                    // <option value="3" selected>Jana Vysoka</option>
                    ?>
                    <option value="<?= $zam['id']; ?>"<?= $zam['id'] === ($oddelenie['veduci'] ?? '') ? ' selected' : ''; ?>><?= $zam['meno']; ?> <?= $zam['priezvisko']; ?></option>
                <?php } ?>
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