<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">My library</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1 class="m-3 text-center"> Welcome Back</h1>


    <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">
        <?php
        if (isset($_SESSION['utenti'])) {
            foreach ($_SESSION['utenti'] as $key => $value) { ?>
                <div class="col">
                    <div class="card">
                        <img src="<?= $value['foto'] ?>" class="card-img-top img-fluid"
                            style="height: 200px; object-fit: cover;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?= "@" . $key ?>
                            </h5>
                            <p class="card-text">
                                <?= ucfirst(strtolower($value['lastname'])) . " " . ucfirst(strtolower($value['firstname'])) ?>
                            </p>
                            <p class="card-text">
                                <?= $value['city'] ?>
                            </p>
                            <p class="card-text"><small class="text-body-secondary">
                                    <?= $value['telnumber'] ?>
                                </small></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }

        ?>
    </div>


    <!-- bootstrap  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>