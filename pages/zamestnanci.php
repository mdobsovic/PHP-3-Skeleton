<h1>Zamestnanci</h1>
<a href="index.php?page=zamestnanci-new" class="btn btn-success">
    <i class="glyphicon glyphicon-plus-sign"></i>
    Pridať zamestnanca
</a>
<table class="table table-hover table-condensed table-striped data-table">
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
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <tr>
            <td>Peter</td>
            <td>Novák</td>
            <td>02/4920 3080</td>
            <td>novak@itlearning.sk</td>
            <td>Personálne oddelenie</td>
            <td>
                <button type="button" class="btn btn-default btn-xs btn-zamestnanci" data-action="edit" data-id="1" title="Upraviť">
                    <i class="glyphicon glyphicon-eye-open"></i>
                    Upraviť
                </button>
                <button type="button" class="btn btn-danger btn-xs btn-zamestnanci" data-action="delete" data-id="1" title="Zmazať">
                    <i class="glyphicon glyphicon-trash"></i>
                    Zmazať
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>