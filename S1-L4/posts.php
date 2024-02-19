<?php
require_once("config.php");
session_start();


$my_db->query("USE db_1");
$add_query = "INSERT INTO posts (titolo, description, img, user_id) VALUES ('" . $_REQUEST['titolo'] . "', '" . $_REQUEST['descrizione'] . "', '" . $_REQUEST['img_src'] . "', " . $_SESSION['user_id'] . ")";
$my_db->query($add_query);
// da rimuovere
echo($add_query);
//
session_write_close();
// exit(header('Location: profilo.php'));
