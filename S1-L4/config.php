<?php

$config = [
    'mysql_host' => 'localhost',
    'mysql_user' => 'php_user',
    'mysql_password' => 'password'
];

$my_db = new mysqli(
    $config['mysql_host'],
    $config['mysql_user'],
    $config['mysql_password']
);

if($my_db->connect_error) { 
    die($my_db->connect_error);
} else {
    // var_dump($my_db);
};

function mysqltoarray($oggetto) {
    $result = [];
    if ($oggetto) { // Controllo se ci sono dei dati nella variabile $res
        while ($row = $oggetto->fetch_assoc()) { // Trasformo $res in un array associativo
            $result[] = $row; // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
            //array_push($contacts, $row); // estraggo ogni singola riga che leggo dal DB e la inserisco in un array
        }
    }
    return $result;
}

