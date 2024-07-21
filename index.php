<?php
    $page = filter_input(INPUT_GET, 'page') ?? 'home';
    
    // konfigurácia prístupov do DB:
    require __DIR__ . '/config/db.php';

    // pripojenie na databázu
    try {
    //    $db = new PDO(DB_DSN, DB_USER, DB_PASS, $pdoOptions);
    } catch (PDOException $e) {

    }

?>
<!doctype html>
<html lang="sk">
<head>
    <title>PDO v PHP</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<?php include __DIR__ . '/navigation.php'; ?>

<div class="container">
    <?php
        if (is_file(__DIR__ . '/pages/' . $page . '.php')) {
            include __DIR__ . '/pages/' . $page . '.php';
        } else {
            include __DIR__ . '/pages/404.php';
        }

        if (isset($hlasenia)) {
            foreach ($hlasenia as $hlasenie) { ?>
            <div class="my-2 alert alert-<?= $hlasenie['typ']; ?>">
                <?php if (isset($hlasenie['ikona'])) { ?>
                    <i class="bi bi-<?= $hlasenie['ikona']; ?>"></i>
                <?php } ?>
                <?= $hlasenie['text']; ?>
            </div>
            <?php
            }
        }
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>