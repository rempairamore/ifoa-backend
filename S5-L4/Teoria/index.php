<?php

//andiamo a leggere il file User.php
require_once('classes/User.php');


$nuovoAdmin1 = new User\Admin("gennaro88","gennaro88@email.com", "Gennaro", "Savastano", "Napoli", "IT5566778899");

echo "<p>" . $nuovoAdmin1->info() . "</p>";


use User\Guest as Anon;

$newGuest = new Anon("mario", "mariolonebubbarello", "mario@email.com");

echo "<p>" . $newGuest->info() . "</p>";