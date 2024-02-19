<?php session_start(); 
  if($_SESSION['login'] === 'true') {
    $my_db->query("USE db_1");
    $result = $my_db->query(' select pictures from utenti where username = "' . $_SESSION['username'] . '"');
    $srcFoto = 'http://ifoa-backend.com/S1-L4/uploads/default.png';
    if ($result->num_rows > 0) {
      // Recupera i dati della prima riga del risultato
      $row = $result->fetch_assoc();

      // Restituisce il valore della colonna 'pictures'
      $srcFoto = $row['pictures']; // Questo è il percorso dell'immagine nell'indice 0
    } else {
      // Nessuna immagine trovata, puoi decidere di restituire false o null
      return false;
    };
    // var_dump($srcFoto);
  }
?>

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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <?php if($_SESSION['login'] !== 'true') {
          ?> 
          <li class="nav-item">
            <a class="nav-link" href="login.php">Log-in</a>
          </li>
           <li class="nav-item">
            <a class="nav-link" href="register.php">Registrati</a>
          </li> <?php
          }; ?>
          <li class="nav-item">
            <a class="nav-link d-none" href="#">Pricing</a>
          </li>
        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <?php
        if($_SESSION['login'] === 'true') {
          ?>
          <a href="profilo.php"><img src="<?= $srcFoto ?>" style="width: 30px; height: 30px;border-radius: 50%; cursor: pointer;" class="mx-3" alt="immagine profilo"> </a>
          <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="profilo.php"><?= $_SESSION['username'] ?></a>
          </li>
          </ul>
          <?php
        }
        ?>
      </div>
    </div>
  </nav>
</header>