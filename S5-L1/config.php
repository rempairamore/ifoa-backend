<?php

    $config = [
        'mysql_host' => 'localhost',
        'mysql_user' => 'root',
        'mysql_password' => ''
    ];

    $mysqli = new mysqli(
        $config['mysql_host'],
        $config['mysql_user'],
        $config['mysql_password']);
    if($mysqli->connect_error) { die($mysqli->connect_error); } 

    $sql = 'CREATE DATABASE IF NOT EXISTS user;';
    if(!$mysqli->query($sql)) { die($mysqli->connect_error); } // Creo il mio DB
 
    $sql= 'USE user;';
    $mysqli ->query($sql);
    // Creo la tabella
    $sqltable = 'CREATE TABLE IF NOT EXISTS users ( 
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        firstname VARCHAR(255) NOT NULL, 
        lastname VARCHAR(255) NOT NULL, 
        city VARCHAR(255) NOT NULL
    )';
    if(!$mysqli->query($sqltable)) { die($mysqli->connect_error); }

    $sqltable2 = 'CREATE TABLE IF NOT EXISTS userscsv ( 
        id INT NOT NULL PRIMARY KEY,
        firstname VARCHAR(255) NOT NULL, 
        lastname VARCHAR(255) NOT NULL, 
        city VARCHAR(255) NOT NULL
    )';
    if(!$mysqli->query($sqltable2)) { die($mysqli->connect_error); }

?>