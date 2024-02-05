<?php require_once("header.php"); require_once ("config.php"); ?>


<!-- BODY -->
<header>
  <nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Users DB</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
        aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Registrati</a>
          </li>
          <li class="nav-item">
            <a class="nav-link d-none" href="#">Pricing</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>
</header>

<main>
  <?php
  $my_db = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password']
);

if($my_db->connect_error) { 
    die($my_db->connect_error);
} else {
    // var_dump($my_db);
} 
$my_db->query('USE db_1;');

// Leggo dati da una tabella
$sql = 'SELECT * FROM utenti;';
$result = [];
$res = $my_db->query($sql); // return un mysqli result
if($res) { // Controllo se ci sono dei dati nella variabile $res
    //var_dump($res);
    while($row = $res->fetch_assoc()) { // Trasformo $res in un array associativo
        // $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
        array_push($result, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
    }
}

// var_dump($result);

?>
  
  <div class="row row-cols-1 row-cols-md-4 g-4 mb-5 mt-4 mx-3">
    <?php
    if (isset($result)) {
      foreach ($result as $key => $value) { ?>
        <div class="col">
          <div class="card">
            <img src="<?= $value['pictures'] ?>" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;"
              alt="...">
            <div class="card-body">
              <h5 class="card-title">
                <?= "@" . $value['username'] ?>
              </h5>
              <p class="card-text">
                <?= ucfirst(strtolower($value['name'])) ?>
              </p>
              <p class="card-text">
                ID: <?= $value['id'] ?>
              </p>
              <p class="card-text"><small class="text-body-secondary">
                  <?= $value['email'] ?>
                </small></p>
                <button type="button" class="btn btn-danger" onclick="window.location.href='delete.php?userId=<?= $value['id'] ?>';">Delete User</button>

            </div>
          </div>
        </div>
        <?php
      }
    }

    ?>
  </div>
</main>

<!-- END BODY -->


<?php require_once("footer.php"); ?>