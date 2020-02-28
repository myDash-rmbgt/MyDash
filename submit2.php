<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);


if (is_array($_POST['fehlstunden']) == true) 
	{
		foreach ($_POST['fehlstunden'] as $key => $value) 
			{
				$sql = "INSERT INTO `fehlstunden` (`schueler_id`, `unterrricht_id`, `status`, `attestname`, `begruendung`) VALUES ($usernr, $value, '0', '".$usernr."-".date('Y-m-d')."','".$_POST['fehltext']."');";
				$pdo->query($sql);
            }
			
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
				$attestname = $usernr."-".date('Y-m-d');
				$file = 'attests/'.$attestname.$ext;
				if (file_put_contents($file, $data)) 
					{
						echo '<meta http-equiv="refresh" content="0; URL=./submit.php?state=1">';		//Die Fehlstunden und das Attest wurden erfolgreich gespeichert.
					}
				else 
					{
						echo '<meta http-equiv="refresh" content="0; URL=./submit.php?state=2">';		//Die Fehlstunden wurden gespeichert, dass Attest jedoch nicht, bitte nachträglich erneut verusuchen.
					}
			}
		else
			{
				echo '<meta http-equiv="refresh" content="0; URL=./submit.php?state=3">';		//Nur die Fehlstunden wurden erfolgreich gespeichert.
			}
    }

else
	{
		echo '<meta http-equiv="refresh" content="0; URL=./submit.php?state=4">';		//Fehler, keine Fehlstunden ausgewählt
	}

?>