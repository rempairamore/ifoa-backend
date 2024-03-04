<?php
require_once('db.php');

function grepTranslation($ciao)
{
    global $mysqli;
    $query = "SELECT " . $_COOKIE['lang'] . " FROM dizionario WHERE id = " . $ciao . " ;";
    $res = $mysqli->query($query);
    if ($res) {
        // Verifica se ci sono righe restituite
        if ($res->num_rows > 0) {
            // Ottieni la riga risultante come array associativo
            $row = $res->fetch_assoc();

            // Accesso al valore della colonna specificata nel $_COOKIE['lang']
            $langValue = $row[$_COOKIE['lang']];

            // Ora puoi utilizzare $langValue come l'output del comando mysqli
            echo $langValue;
        } else {
            // Nessuna riga restituita
            echo "Nessun risultato trovato.";
        }
    } else {
        // Gestione degli errori nel caso la query non vada a buon fine
        echo "Errore nella query: " . $mysqli->error;
    }

    // Ricordati di liberare la memoria dell'oggetto risultato
    $res->free();

    // Chiudi la connessione al database
    // $mysqli->close();
}

