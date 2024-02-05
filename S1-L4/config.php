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