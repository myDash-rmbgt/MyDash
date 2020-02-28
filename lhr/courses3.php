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
	
$stundennr = explode(",", $_POST['stundennr']);
			
$wochentag = $_POST['wochentag'];

if (is_array($_POST['fehlstunden']) == true) 
	{
		foreach ($_POST['fehlstunden'] as $key => $value) 
			{
				foreach ($stundennr as $key2 => $value2) 
					{	
					echo $value2;
						$statement = $pdo->prepare("SELECT unterricht.id FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON unterrichts_id=id WHERE zuordnung_schueler_unterricht.schueler_id=$value AND unterricht.wochentag=$wochentag AND unterricht.stundennr=$value2 AND unterricht.archived=0");
						$result = $statement->execute();
						while($row = $statement->fetch())
							{
								$sql = "INSERT INTO `fehlstunden` (`schueler_id`, `unterrricht_id`, `status`, `attestname`, `begruendung`) VALUES ($value, $row[0], '2', '','nicht anwesend')";
								$pdo->query($sql);
							}
					}
            }


echo '<meta http-equiv="refresh" content="0; URL=./courses.php?state=1">';	
}}
?>