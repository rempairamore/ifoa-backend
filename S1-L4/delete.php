<?php

require_once ("config.php");

if (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
    // echo $userId;
    // Fai qualcosa con $userId, come una query al database per eliminare l'utente
} else {
    // Se userId non è presente nella query string, gestisci l'errore o imposta un comportamento di default
    echo "ID utente non specificato.";
}

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


$query = "DELETE FROM utenti WHERE id = '" . $userId . "';";

$my_db->query("USE db_1;");
$my_db->query($query);

exit(header('Location: index.php'));
