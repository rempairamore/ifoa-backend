<?php
session_start();



// Funzione per verificare le credenziali
function loginUser(string $mail, string $password, array $usersData): bool {
    foreach ($usersData as $userData) {
        // Verifica se la mail e la password corrispondono
        if (isset($userData['mail']) && isset($userData['password']) &&
            $userData['mail'] === $mail && $userData['password'] === $password) {
            return true; // Credenziali valide
        }
    }
    return false; // Credenziali non valide
}

// Array degli utenti (prende l'array dalla sessione o inizializza un array vuoto)
$usersData = isset($_SESSION['utenti']) ? $_SESSION['utenti'] : array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredMail = isset($_POST['email']) ? $_POST['email'] : '';
    $enteredPassword = isset($_POST['password']) ? $_POST['password'] : '';

    if (loginUser($enteredMail, $enteredPassword, $usersData)) {
        // Credenziali valide, imposta la sessione
        $_SESSION['utente_loggato'] = $enteredMail;
        header('Location: index.php');
      
    } else {
        // Credenziali non valide, mostra un messaggio di errore
        echo "Credenziali non valide. Riprova.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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

<form method="post" action="login.php" class="mx-3 mt-3">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
