<?php


include_once('db.php');

extract($_REQUEST);

session_start();

$_SESSION['usuario']=$usuario;


$query="SELECT password from account where name='".trim($usuario)."'";
$password = pg_query($conexion, $query);

print_r($password);

//$hashToStoreInDb = password_hash($password, PASSWORD_BCRYPT);
//$isPasswordCorrect = password_verify($password, $existingHashFromDb);




?>