<?php
require_once 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prendi i dati dal form
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $city = $_POST['city'];
 
    $nome = $mysqli->real_escape_string($_POST['nome']);
    $cognome = $mysqli->real_escape_string($_POST['cognome']);
    $city = $mysqli->real_escape_string($_POST['city']);
    
    $sql = "INSERT INTO users (firstname, lastname, city) VALUES ('$nome', '$cognome', '$city')";
    if (!$mysqli->query($sql)) {
        echo "Errore nell'inserimento: " . $mysqli->error;
    } else {
        echo 'Record aggiunto con successo!!!';
        header("Location: index.php?add=success", true, 301);
        exit;
    }
}
?>