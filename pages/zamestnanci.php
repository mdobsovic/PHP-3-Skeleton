<h1>Zamestnanci</h1>
<a href="index.php?page=zamestnanci-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať zamestnanca
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
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
                    <a href="/?page=zamestnanci-edit&id=1" class="btn btn-primary btn-sm" title="Upraviť">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm zamestnanci-delete" data-id="1" title="Zmazať">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>