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
	

			

if (is_array($_POST['aktion']) == true) 
	{
		foreach ($_POST['aktion'] as $key => $value) 
			{			
					list($typ, $userid, $datum) = explode(",", $value);
						
						if($typ==1)
						{
							$statement = $pdo->prepare("UPDATE fehlstunden SET status=1 WHERE schueler_id=$userid AND datum='$datum'");
							$result = $statement->execute();	
							$statement->fetch();
						}
						
						if($typ==2)
						{
							$statement = $pdo->prepare("UPDATE fehlstunden SET status=2 WHERE schueler_id=$userid AND datum='$datum'");
							$result = $statement->execute();	
							$statement->fetch();
						}
					
            }


echo '<meta http-equiv="refresh" content="0; URL=./mitteilungen.php?state=1">';	
}

echo '<meta http-equiv="refresh" content="0; URL=./mitteilungen.php?state=0">';	
}
?>