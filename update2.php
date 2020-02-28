<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);

if(isset($_POST['absenden']))
	{
		//$statement = $pdo->prepare("DELETE FROM zuordnung_schueler_unterricht WHERE schueler_id=$usernr");
		//$result = $statement->execute();	
		//$statement->fetch();
		
		$wochentag=1;
		
		
		while($wochentag<6)
			{	
				$stundennr=1;
				while($stundennr<9)
					{
					$selected_val = $_POST[$wochentag.$stundennr];
					if($selected_val!=0)
						{
							$statement = $pdo->prepare("INSERT INTO zuordnung_schueler_unterricht (unterrichts_id, schueler_id) VALUES ('$selected_val', '$usernr')");
							$result = $statement->execute();	
							$statement->fetch();
							
						}
					$stundennr=$stundennr+1;
					}
				$wochentag=$wochentag+1;
			}
			
		$statement = $pdo->prepare("UPDATE users SET stundenplanversion=NOW() WHERE id=$usernr");
		$result = $statement->execute();	
		$statement->fetch();
		echo '<meta http-equiv="refresh" content="0; URL=./dashboard.php?state=1">';
	}

?>

