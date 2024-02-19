<?php require_once("header.php");
require_once("config.php"); ?>


<!-- BODY -->
<?php require_once("navbar.php");
session_start(); ?>



<main>
  <?php
  if ($_SESSION['login'] === 'true') {
    // Leggo dati da una tabella
  
    $my_db->query('USE db_1;');
    $sql = 'SELECT * FROM utenti;';
    $result = [];
    $res = $my_db->query($sql); // return un mysqli result
    if ($res) { // Controllo se ci sono dei dati nella variabile $res
      //var_dump($res);
      while ($row = $res->fetch_assoc()) { // Trasformo $res in un array associativo
        // $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
        array_push($result, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
      }
    }

  } else {
    echo "<p class='m-4'>Please consider login (or create a new account).</p>";
  }
  ;



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
                ID:
                <?= $value['id'] ?>
              </p>
              <p class="card-text"><small class="text-body-secondary">
                  <?= $value['email'] ?>
                </small></p>
              <button type="button" class="btn btn-danger"
                onclick="window.location.href='delete.php?userId=<?= $value['id'] ?>';">Delete User</button>

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