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