<?php 

require_once 'config.php';

$dir = 'files/';
$file = 'users.csv';

if(!file_exists($dir)) {
    mkdir($dir, 0777);
} 

$utenti = [];

$sql = 'SELECT * FROM users;';
$datiUtenti =  $mysqli ->query($sql);
/* var_dump($datiUtenti); */
foreach($datiUtenti as $datiUtenti) {
    $utenti[] = $datiUtenti; 
}
/* var_dump($utenti); */

$resource = fopen($dir.$file, 'w');
if($resource) {
    foreach($utenti as $user) {
        fputcsv($resource, $user, ',');
    }
    fclose($resource);
}


$mysqli ->query('DELETE FROM userscsv');
$resource = fopen($dir.$file, 'r');
while($data = fgetcsv($resource)) {
  var_dump($data);
 /*  $querySql = "SELECT * FROM userscsv WHERE id = $data "; */
  $sql = "INSERT INTO userscsv (id, firstname, lastname, city) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]')";
  $mysqli ->query($sql);

}
fclose($resource);  

header("Location: index.php?csv=success", true, 301);
exit;

