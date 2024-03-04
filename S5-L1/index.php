<?php require_once 'config.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP S5-L1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <h1 class="m-3">Benvenuti</h1>
    <form class="row g-3 m-3" method="POST" action="controller.php">
  <div class="col-md-6">
    <label for="inputnome" class="form-label">Nome</label>
    <input type="text" class="form-control" id="inputnome" name="nome">
  </div>
  <div class="col-md-6">
    <label for="inputcognome" class="form-label">Cognome</label>
    <input type="text" class="form-control" id="inputcognome" name="cognome">
  </div>
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" id="inputCity" name="city">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Invia dati al DB</button>
  </div>
</form>

<div class="col-12 m-3 mt-5">
    <button type="submit" onclick="window.location.href='index_csv.php'" class="btn btn-primary">Esporta dati in csv</button>
  </div>

<?php if ($_GET['add'] === 'success') {
    print '<h3>Dati inviati con successo</h3>';
}else if ($_GET['csv'] === 'success') {
    print '<h3>Dati CSV inseriti con successo nel Database</h3>';
} ?>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>