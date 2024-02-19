<?php

require_once ("config.php");


// var_dump($_REQUEST);
// exit;


if($_REQUEST["mode"] === 'login') {
    // Funzione per verificare le credenziali
    $my_db->query("USE db_1");
    $sql_query = 'SELECT * FROM utenti WHERE username ="' . $_REQUEST['username'] . '"';
    $result_user = $my_db->query($sql_query);

    $utente = mysqltoarray($result_user);

    if(isset($utente[0])) {
        // echo "user esiste";
        if(password_verify($_REQUEST['password'], $utente[0]['pwd'])) {
            // echo 'tutto ok';
            session_start();
            $_SESSION["username"] = $_REQUEST['username'];
            $_SESSION['login'] = 'true';
            $_SESSION["user_id"] = $utente[0]['id'];

            session_write_close();
            exit(header('Location: index.php'));


        } else {
            // echo "password no buona";
            exit(header('Location: login.php?errore=pwd'));
            
        }
    } else {
        // echo "user non esiste";
        exit(header('Location: login.php?error=user'));
    };
    
    
}

// upload file PHP
   if($_FILES['fotoFile']['type'] === 'image/jpeg' || $_FILES['fotoFile']['type'] === 'image/png') {
    //    print_r($_FILES['fotoFile']);
       $file_name = $_FILES['fotoFile']['name'];
       $senza_spazi = str_replace(' ', '', $file_name);
       
       $target_dir = 'uploads/';
       $tutta_dir = $target_dir . $senza_spazi;
       // print $tutta_dir;
       if(is_uploaded_file($_FILES['fotoFile']["tmp_name"]) && $_FILES['fotoFile']["error"] === UPLOAD_ERR_OK) {
           if(move_uploaded_file($_FILES['fotoFile']['tmp_name'], $tutta_dir)){
               echo "mbare tutto appoggio";
           } else {
               echo "vez c'è qualcosa che non va";
           }
       }
   } else  {
    echo "qualcosa è andato storto";
   };


// TEST DEGLI INPUT 
function printUserData(string $input): void {
    $data = filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING);

    if ($data !== false && preg_match('/^[A-Za-z ]+$/', $data)) {
        echo "Name: <span class='fw-light'>$data</span> <br/>";
    } else {
        echo "Invalid Name";
        exit();
    }
}

printUserData("firstname");


function validateAndPrintUsername(string $input): void {
    $username = filter_input(INPUT_POST, $input, FILTER_SANITIZE_STRING);

    // Può contenere numeri o caratteri speciali
    // L'espressione regolare consente lettere, numeri, e alcuni caratteri speciali comuni
    if ($username !== false && preg_match('/^[A-Za-z0-9\-_!@#$%^&*()+=<>?\/.,;:|\[\]{}]+$/', $username)) {
        echo "Username: <span class='fw-light'>$username</span> <br/>";
    } else {
        echo "Invalid Username";
        exit();
    }
}

validateAndPrintUsername("username");

$email = $_POST['mail'];
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "$email è un valore valido <br/>";
} else {
    echo "$email  NON è una valore valido";
};

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
};



// tutta dir per DB 
$dir_per_db = "http://ifoa-backend.com/S1-L4/" . $tutta_dir;


// Seleziono il DB
$my_db->query('USE db_1;');
$test = $my_db->query('SHOW tables;');

$insert_user = "
    INSERT INTO utenti (name, email, pwd, username, pictures) VALUES (
        '" . $_POST['firstname'] . "',
        '" . $_POST['mail'] . "',
        '" . password_hash($_POST['password'], PASSWORD_DEFAULT) . "',
        '" . $_POST['username'] . "',
        '" . $dir_per_db . "'
    )
";

$my_db->query($insert_user);

exit(header('Location: index.php'));

