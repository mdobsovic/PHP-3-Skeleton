<h1>Oddelenia</h1>
<a href="index.php?page=oddelenia-new" class="btn btn-success">
    <i class="glyphicon glyphicon-plus-sign"></i>
    Pridať oddelenie
</a>
<table class="table table-hover table-condensed table-striped data-table">
    <thead>
    <tr>
        <th>Názov</th>
        <th>Vedúci</th>
        <th>Počet zamestnacov</th>
        <th>Možnosti</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <tr>
            <td>Personálne oddelenie</td>
            <td>Peter Novák</td>
            <td>
                <span class="badge">14</span>
            </td>
            <td>
                <button type="button" class="btn btn-default btn-xs btn-oddelenia" data-action="edit" data-id="1" title="Upraviť">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    Upraviť
                </button>
                <button type="button" class="btn btn-danger btn-xs btn-oddelenia" data-action="delete" data-id="1" title="Zmazať" disabled="disabled">
                    <i class="glyphicon glyphicon-trash"></i>
                    Zmazať
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>