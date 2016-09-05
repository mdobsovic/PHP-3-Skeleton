<?php
    $page = filter_input(INPUT_GET, 'page');
    if ($page === NULL) {
        $page = 'home';
    }

    // konfigurácia prístupov do DB:
    require __DIR__ . '/config/db.php';

    // pripojenie na databázu
    try {
        $db = new PDO(DB_DSN, DB_USER, DB_PASS, $pdoOptions);
    } catch (PDOException $e) {

    }

?>
<!doctype html>
<html>
<head>
    <title>PDO v PHP</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="assets/bootstrap/dist/css/bootstrap.css">
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
    ?>
</div>

<script type="text/javascript" src="assets/jquery/dist/jquery.min.js"></script>
<script type="text/javascript" src="assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>