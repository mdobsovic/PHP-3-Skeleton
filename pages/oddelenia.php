<h1>Oddelenia</h1>
<a href="index.php?page=oddelenia-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať oddelenie
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
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
                    <span class="badge text-bg-secondary">14</span>
                </td>
                <td>
                    <a href="/?page=oddelenia-edit&id=1" class="btn btn-primary btn-sm" title="Upraviť">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <button type="button" class="btn btn-danger btn-sm oddelenia-delete" data-id="1" title="Zmazať">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>