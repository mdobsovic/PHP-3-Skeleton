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
  <main class="w-100 m-auto form-signin">
    <form method="post" action="/login.php">
      <h1 class="h3 mb-3 fw-normal">Prihlasovanie</h1>

      <div class="form-floating">
        <input type="text" name="username" class="form-control" id="username" placeholder="">
        <label for="username">Prihlasovacie meno</label>
      </div>
      
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="password" placeholder="">
        <label for="password">Heslo</label>
      </div>

      <button class="btn btn-primary w-100 py-2" type="submit">Prihlásiť sa</button>
    </form>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>