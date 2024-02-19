<?php require_once("header.php");
require_once("config.php");
session_start(); ?>
<?php require_once("navbar.php"); ?>

<!-- BODY -->

<?php

$miei_dati = [];
$my_db->query("USE db_1");
$sql = 'SELECT * from utenti where username = "' . $_SESSION['username'] . '"';

// Leggo dati da una tabella

$result = [];
$res = $my_db->query($sql); // return un mysqli result
if ($res) { // Controllo se ci sono dei dati nella variabile $res
    //var_dump($res);
    while ($row = $res->fetch_assoc()) { // Trasformo $res in un array associativo
        // $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
        array_push($result, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
    }
}

$result = $result[0];

?>

<div class="d-flex justify-content-center">
    <form method="POST" class="row g-3 needs-validation m-3" action="gestione.php" enctype="multipart/form-data"
        novalidate>
        <div class="col-md-2">
            <label for="validationCustom01" class="form-label">Full name</label>
            <input type="text" class="form-control" name="firstname" value="<?= $result['name'] ?>" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>

        <div class="col-md-2">
            <label for="validationCustomUsername" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" class="form-control" name="username" aria-describedby="inputGroupPrepend"
                    value="<?= $result['username'] ?>" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <label for="validationCustom06" class="form-label">e-Mail</label>
            <input type="email" class="form-control" name="mail" value="<?= $result['email'] ?>" required>
            <div class="invalid-feedback">
                Please provide a valid email.
            </div>
        </div>
        <div class="col-md-2">
            <label for="validationCustom06" class="form-label">Current Password</label>
            <input type="password" class="form-control" name="password"
                placeholder=">8 char w/ one capitale letter and one number" required>
        </div>
        <div class="col-md-2">
            <label for="validationCustom06" class="form-label">New Password</label>
            <input type="password" class="form-control" name="password"
                placeholder=">8 char w/ one capitale letter and one number" required>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Submit form</button>
        </div>
</div>
</form>
</div>

<div class="mx-3 mt-4">


    <h3 class="fw-bold">Add New Post:</h3>


    <form method="POST" class="needs-validation" action="posts.php" enctype="multipart/form-data"
        novalidate>
        <!-- Campo Titolo -->
        <div class="mb-3">
            <label for="titolo" class="form-label">Titolo</label>
            <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Inserisci il titolo">
        </div>

        <!-- Campo Descrizione -->
        <div class="mb-3">
            <label for="descrizione" class="form-label">Descrizione</label>
            <textarea class="form-control" id="descrizione" name="descrizione" rows="3"
                placeholder="Inserisci la descrizione"></textarea>
        </div>

        <!-- Campo Img_src -->
        <div class="mb-3">
            <label for="img_src" class="form-label">Percorso Immagine (img_src)</label>
            <input type="text" class="form-control" id="img_src" name="img_src"
                placeholder="Inserisci il percorso dell'immagine">
        </div>

        <!-- Pulsante di Invio -->
        <button type="submit" class="btn btn-primary">Invia</button>
    </form>


    <h3 class="m-4">Posts:</h3>

    <div class="container mt-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $my_db->query("USE db_1");
                $sql = 'SELECT * FROM posts WHERE user_id = ' . $_SESSION['user_id'];
                $result = [];
                $res = $my_db->query($sql); // return un mysqli result
                if ($res) { // Controllo se ci sono dei dati nella variabile $res
                    //var_dump($res);
                    while ($row = $res->fetch_assoc()) { // Trasformo $res in un array associativo
                        // $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
                        array_push($result, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
                    }
                }
                foreach ($result as $row) {
                   ?>
                   <tr>
                    <th scope="row"><?= $row['id'] ?></th>
                    <td><img src="<?= $row['img'] ?>" alt="Esempio immagine" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                    <td><?= $row['titolo'] ?></td>
                    <td><?= $row['description'] ?>
                    </td>
                </tr>
                
                <?php

                }


                ?>
                
            </tbody>
        </table>
    </div>

</div>
<!-- END BODY -->


<?php require_once("footer.php"); ?>