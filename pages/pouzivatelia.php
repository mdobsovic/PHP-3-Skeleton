<h1>Používatelia</h1>
<a href="index.php?page=pouzivatelia-new" class="btn btn-success">
    <i class="bi bi-plus-circle"></i>
    Pridať používateľa
</a>
<table class="mt-3 table table-hover table-condensed data-table align-middle">
    <thead>
        <tr>
            <th>Meno</th>
            <th>Priezvisko</th>
            <th>Prihlasovacie meno</th>
            <th>E-mail</th>
            <th>Možnosti</th>
        </tr>
    </thead>
    <tbody>
    <?php for ($i = 0; $i < 10; $i++) { ?>
        <tr>
            <td>Peter</td>
            <td>Novák</td>
            <td>peter.novak</td>
            <td>novak@itlearning.sk</td>
            <td>
                <a href="/?page=pouzivatelia-edit&id=1" class="btn btn-primary btn-sm" title="Upraviť">
                    <i class="bi bi-pencil"></i>
                </a>
                <a href="/?page=pouzivatelia-heslo&id=1" class="btn btn-warning btn-sm" title="Resetovať heslo">
                    <i class="bi bi-key"></i>
                </a>
                <button type="button" class="btn btn-danger btn-sm pouzivatelia-delete" data-id="1" title="Zmazať">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>