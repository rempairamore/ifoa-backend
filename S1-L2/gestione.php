<?php

    // print_r($_POST);
    if($_FILES['fotoFile']['type'] === 'image/jpeg' || $_FILES['fotoFile']['type'] === 'image/png') {
        // print_r($_FILES['fotoFile']);
        $file_name = $_FILES['fotoFile']['name'];
        $senza_spazi = str_replace(' ', '', $file_name);
        
        $target_dir = 'uploads/';
        $tutta_dir = $target_dir . $senza_spazi;
        // print $tutta_dir;
        if(is_uploaded_file($_FILES['fotoFile']["tmp_name"]) && $_FILES['fotoFile']["error"] === UPLOAD_ERR_OK) {
            if(move_uploaded_file($_FILES['fotoFile']['tmp_name'], $tutta_dir)){
                // echo "mbare tutto appoggio";
            } else {
                echo "vez c'è qualcosa che non va";
            }
        }
    } else {?>
    <h3>A zi Me devi da na foto</h3>
    <?php }


    ?>
    <h3 class="m-3">Dati Utente:</h3>
    
    <div class="d-flex row m-3">
        <div class="col-6">
            <h4>Name: <span class='fw-light'> <?php echo $_POST['firstname']; ?> </span> </h4>
            <h4>Surname: <span class='fw-light'> <?php echo $_POST['lastname']; ?> </span> </h4>
            <h4>Username: <span class='fw-light'> <?php echo $_POST['username']; ?> </span> </h4>
            <h4>City: <span class='fw-light'> <?php echo $_POST['city']; ?> </span> </h4>
            <h4>Telephone Number: <span class='fw-light'> <?php echo $_POST['telnumber']; ?> </span> </h4>
        </div>
        <div class="col-6">
            <img class="immagineProfilo" src="<?= $tutta_dir ?>" alt="profile_image">
        </div>
    </div>

    <div class="m-3">
        <button type="button" class="btn btn-primary" onclick="location.href='index.php'">Back to Home Page</button>
    </div>
    
    
    
    <?php





        session_start(); // inizializza una sessione su browser del client
        // print_r($_POST);
        $_SESSION['utenti'][$_POST['username']] = $_POST;
        $_SESSION['utenti'][$_POST['username']]['foto'] = $tutta_dir;

        session_write_close();
        // var_dump($_SESSION);




?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BackEnd Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
</head>
</head>
<body>
    <!-- <p>WeWe</p> -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous">
    </script>
</body>
</html>