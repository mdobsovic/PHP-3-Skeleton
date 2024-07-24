<?php
// ak pouzivatel nie je prihlaseny, zobrazim chybove hlasenie
    if (!isset($_SESSION['user'])) {
        $hlasenia[] = [
            'typ' => 'danger',
            'text' => 'Táto funkcia je iba pre prihlásených používateľov.',
            'ikona' => 'x-circle',
        ];
        return;
    }

    if (isset($_GET['err'])) {
        // switch ($_GET['err']) {
        //     case '1':
        //         $text = 'Aktuálne heslo nie je správne.';
        //         break;
        //     case '2':
        //         $text = 'Heslo musí mať minimálne 8 znakov.';
        //         break;
        //     case '3':
        //         $text = 'Heslo musí obsahovať aspoň 1 malé písmeno, aspoň 1 veľké písmeno a aspoň jednu číslicu.';
        //         break;
        //     case '4':
        //         $text = 'Nové heslo a potvrdenie hesla sa nezhodujú.';
        //         break;
        //     default:
        //         $text = 'Nastala chyba.';
        //         break;
        // }
        $text = match($_GET['err']) {
            '1' => 'Aktuálne heslo nie je správne.',
            '2' => 'Heslo musí mať minimálne 8 znakov.',
            '3' => 'Heslo musí obsahovať aspoň 1 malé písmeno, aspoň 1 veľké písmeno a aspoň jednu číslicu.',
            '4' => 'Nové heslo a potvrdenie hesla sa nezhodujú.',
            default => 'Nastala chyba.',
        };
        $hlasenia[] = [
            'typ' => 'danger',
            'text' => $text,
            'ikona' => 'x-circle',
        ];
    }
?>
<form method="post" action="/change-password.php" class="form-horizontal">
    <h1>Zmeniť heslo</h1>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="aktualne">Aktuálne heslo:</label>
        <div class="col-md-4">
            <input type="password" id="aktualne" name="aktualne" class="form-control">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="nove">Nové heslo:</label>
        <div class="col-md-4">
            <input type="password" id="nove" name="nove" class="form-control">
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-form-label col-md-4" for="potvrdenie">Potvrdenie nového hesla:</label>
        <div class="col-md-4">
            <input type="password" id="potvrdenie" name="potvrdenie" class="form-control">
        </div>
    </div>

    <div class="mb-3 row">
        <div class="col-md-4 offset-md-4">
            <button type="submit" id="submit" name="submit" class="btn btn-primary">
                <i class="bi bi-floppy"></i>
                Zmeniť heslo
            </button>

            <a href="/" class="btn btn-danger">
                <i class="bi bi-x-circle"></i>
                Zrušiť
            </a>
        </div>
    </div>
</form>