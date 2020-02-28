<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
?>


        <?php if(!is_checked_in())
		{ 
			?>
					<script>
					window.location = "./login.php";
					</script>
					<?php
		} 
		
		else
		{
			$user = check_user();
			$usernr = ($user['id']);
			$usertyp = ($user['typ']);
			
			$statement = $pdo->prepare("SELECT klassen.currentstundenplan, users.stundenplanversion FROM users INNER JOIN klassen ON users.klassen_id=klassen.id WHERE users.id=$usernr AND klassen.currentstundenplan >= users.stundenplanversion");
			$result = $statement->execute();
			$stundenplan = $statement->fetch();
		
			if($usertyp==0)
			{
			
			if($stundenplan !== false) 
				{
					?>
					<script>
					window.location = "./update.php";
					</script>
					<?php
				}
			else
				{	
					?>
					<script>
					window.location = "./dashboard.php";
					</script>
					<?php
				}
			}
			
			if($usertyp==1)
				{
					?>
					<script>
					window.location = "./lhr/dashboard.php";
					</script>
					<?php
				}
		} 
?>