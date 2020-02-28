<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);


			
		if (count($_POST) && (strpos($_POST['img'], 'data:image') === 0)) 
			{
				$img = $_POST['img'];
				if (strpos($img, 'data:image/jpeg;base64,') === 0) 
					{
						$img = str_replace('data:image/jpeg;base64,', '', $img);  
						$ext = '.jpg';
					}
				if (strpos($img, 'data:image/png;base64,') === 0) 
					{
						$img = str_replace('data:image/png;base64,', '', $img); 
						$ext = '.png';
					}
				$img = str_replace(' ', '+', $img);
				$data = base64_decode($img);
				$attestname = $usernr."-".$_POST['datum'];
				$file = 'attests/'.$attestname.$ext;
				if (file_put_contents($file, $data)) 
					{
						echo '<meta http-equiv="refresh" content="0; URL=./overview.php?state=1">';		//Erfolgreich gespeichert.
					}
				else 
					{
						echo '<meta http-equiv="refresh" content="0; URL=./overview.php?state=2">';		//Fehler
					}
			}
		else
			{
				echo '<meta http-equiv="refresh" content="0; URL=./overview.php?state=2">';		//Fehler
			}


?>