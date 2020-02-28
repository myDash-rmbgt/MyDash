<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);

if(isset($_POST['absenden']))
	{
		
		$klassenid=$_POST['klassenid'];
		
		$statement = $pdo->prepare("UPDATE unterricht SET archived=1 WHERE klassen_id=$klassenid");
		$result = $statement->execute();	
		$statement->fetch();
		
		$wochentag=1;
		while($wochentag<6)
			{	
				$stundennr=1;
				while($stundennr<9)
					{
						$position=1;
						while($position<4)
							{
								$selected_bez = $_POST['bez'.$position.$wochentag.$stundennr];
								$selected_lhr = $_POST['lhr'.$position.$wochentag.$stundennr];
					
					
								if($selected_lhr!=0)
									{
										$statement = $pdo->prepare("INSERT INTO unterricht (klassen_id, lehrer_id, bezeichnung, wochentag, stundennr) VALUES ('$klassenid', '$selected_lhr', '$selected_bez', '$wochentag', '$stundennr')");
										$result = $statement->execute();	
										$statement->fetch();
							
									}
								$position=$position+1;
							}
					$stundennr=$stundennr+1;
					}
				$wochentag=$wochentag+1;
			}
			
		$statement = $pdo->prepare("UPDATE klassen SET currentstundenplan=NOW() WHERE id=$klassenid");
		$result = $statement->execute();	
		$statement->fetch();
		
		echo '<meta http-equiv="refresh" content="0; URL=./classes.php?state=8">';
	}

?>

