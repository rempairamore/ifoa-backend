<?php

// print_r($_POST);
if ($_FILES['fotoFile']['type'] === 'image/jpeg' || $_FILES['fotoFile']['type'] === 'image/png') {
    // print_r($_FILES['fotoFile']);
    $file_name = $_FILES['fotoFile']['name'];
    $senza_spazi = str_replace(' ', '', $file_name);

    $target_dir = 'uploads/';
    $tutta_dir = $target_dir . $senza_spazi;
    // print $tutta_dir;
    if (is_uploaded_file($_FILES['fotoFile']["tmp_name"]) && $_FILES['fotoFile']["error"] === UPLOAD_ERR_OK) {
        if (move_uploaded_file($_FILES['fotoFile']['tmp_name'], $tutta_dir)) {
            // echo "mbare tutto appoggio";
        } else {
            echo "vez c'è qualcosa che non va";
        }
    }
} else { ?>
    <h3>A zi Me devi da na foto</h3>
<?php }

?>




<?php




function printUserData(string $input): void {
    $data = filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING);

    if ($data !== false && preg_match('/^[A-Za-z ]+$/', $data)) {
        echo "Name: <span class='fw-light'>$data</span> <br/>";
    } else {
        echo "Invalid Name";
        exit();
    }
}

printUserData('firstname');
printUserData('lastname');
printUserData('city');

function validateAndPrintUsername(string $input): void {
    $username = filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING);

    // Può contenere numeri o caratteri speciali
    // L'espressione regolare consente lettere, numeri, e alcuni caratteri speciali comuni
    if ($username !== false && preg_match('/^[A-Za-z0-9\-_!@#$%^&*()+=<>?\/.,;:|\\[\]{}]+$/', $username)) {
        echo "Username: <span class='fw-light'>$username</span> <br/>";
    } else {
        echo "Invalid Username";
        exit();
    }
}

// Esempio di utilizzo per $_POST['username']
validateAndPrintUsername('username');


$email = $_POST['mail'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "$email è un valore valido <br/>";
} else {
    echo "$email  NON è una valore valido";
}


$phoneNumber = $_POST['telnumber'];
$phoneNumberDigitsOnly = preg_replace('/[^0-9+]/', '', $phoneNumber);
if (preg_match('/^\+?[0-9]{11}$/', $phoneNumberDigitsOnly) && ((filter_var($phoneNumberDigitsOnly, FILTER_VALIDATE_INT)))) {
    echo "Valid Phone Number end int";
} else {
    echo "Invalid Phone Number";
    exit();
} 



echo $phoneNumberDigitsOnly;


function validatePassword(string $password): bool {
    // La password deve avere almeno 8 caratteri
    // La password deve contenere almeno una lettera maiuscola
    // La password deve contenere almeno una lettera minuscola
    // La password deve contenere almeno un numero
    // La password può contenere caratteri speciali (modifica se necessario)
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/';

    return preg_match($pattern, $password) === 1;
}

// Esempio di utilizzo
$password = $_POST['password'];

if (validatePassword($password)) {
    echo "Password valida.";
} else {
    echo "La password non rispetta i requisiti minimi.";
    exit();
}


session_start(); // inizializza una sessione su browser del client
// print_r($_POST);
$_SESSION['utenti'][$_POST['username']] = $_POST;
$_SESSION['utenti'][$_POST['username']]['foto'] = $tutta_dir;

session_write_close();
// var_dump($_SESSION);

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'sandbox.smtp.mailtrap.io';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = '082c6e35cc51b3';                     //SMTP username
    $mail->Password   = '19cabefe7f97fc';                               //SMTP password           //Enable implicit TLS encryption
    $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    //Recipients
    $mail->setFrom('admin@example.com', 'Gennaro Mutti');
    $mail->addAddress($email, $_POST['firstname'] . '' . $_POST['lastname']);     //Add a recipient          //Name is optional
    $mail->addReplyTo('admin@example.com', 'Information');

    //Attachments
    $mail->addAttachment($tutta_dir);         //Add attachments
       //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Grazie per esserti Registrato al nostro sito';
    $mail->Body    = '<h1>Welcome!<h1/><p>Ti aspettiamo, a presto<p/>';


    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


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
    <h3 class="m-3">Dati Utente:</h3>

<div class="d-flex row m-3">
    <div class="col-6">
        <h4>Name: <span class='fw-light'>
                <?php echo $_POST['firstname']; ?>
            </span> </h4>
        <h4>Surname: <span class='fw-light'>
                <?php echo $_POST['lastname']; ?>
            </span> </h4>
        <h4>Username: <span class='fw-light'>
                <?php echo $_POST['username']; ?>
            </span> </h4>
        <h4>City: <span class='fw-light'>
                <?php echo $_POST['city']; ?>
            </span> </h4>
        <h4>Telephone Number: <span class='fw-light'>
                <?php echo $_POST['telnumber']; ?>
            </span> </h4>
            <h4>Email: <span class='fw-light'>
                <?php echo $_POST['mail']; ?>
            </span> </h4>
            <h4>Password: <span class='fw-light'>
                <?php echo $_POST['password']; ?>
            </span> </h4>
    </div>
    <div class="col-6">
        <img class="immagineProfilo" src="<?= $tutta_dir ?>" alt="profile_image">
    </div>
</div>

<div class="m-3">
    <button type="button" class="btn btn-primary" onclick="location.href='index.php'">Back to Home Page</button>
</div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
</body>

</html>