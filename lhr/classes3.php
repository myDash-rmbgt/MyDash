<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$usertyp = ($user['typ']);

	
if ($usertyp==1){
	
	
$id = $_GET['id'];

//Schüler aus Datenbnk löschen

$statement = $pdo->prepare("DELETE FROM users WHERE id=$id");
$result = $statement->execute();	
$row = $statement->fetch(); 

echo '<meta http-equiv="refresh" content="0; URL=./classes.php?state=2">';	
}
?>
