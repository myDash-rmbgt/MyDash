<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$usertyp = ($user['typ']);

$id = $_POST['id'];
$bez = $_POST['bez'];
	
if ($usertyp==1){
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    myDASH - RMBGT
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <style>
    select {
        width: 150px;
    }
    select:focus {
        min-width: 150px;
    }    
</style>
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="./dashboard.php" class="simple-text logo-mini">
          <img src="../logo_rmb.png">
        </a>
        <a href="./dashboard.php" class="simple-text logo-normal">
          myDASH - RMBGT
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="./dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./classes.php">
              <i class="now-ui-icons ui-1_settings-gear-63"></i>
              <p>Eigene Klassen</p>
            </a>
          </li>
          <li class="active">
            <a href="./courses.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Meine Kurse</p>
            </a>
          </li>
          <li>
            <a href="./mitteilungen.php">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Mitteilungen</p>
            </a>
          </li>
          <li class="active-pro">
            <a href="./settings.php">
              <i class="now-ui-icons users_single-02"></i>
              <p>Userprofil</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>

            </form>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../logout.php">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Logout</span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
		<div class="panel-header panel-header-sm">
        </div>
	  
      <div class="content">
        
		<div class="col-md-12">
		<form action="./courses3.php" method="post">
            <div class="card">
              <div class="card-body">
               
			 
			 <h4>Anwesenheit von <?php echo $bez; ?> erfassen</h4>	 
			 

	  <?php
				$wochentag=date("N");

				$statement = $pdo->prepare("SELECT DISTINCT stundennr FROM `unterricht` WHERE id IN($id) AND wochentag=$wochentag ORDER BY stundennr");
				$result = $statement->execute();
				$anzahl=$statement->rowCount();
				
				if ($anzahl==0)
				{echo "Am heutigen Wochentag haben Sie kein Unterricht in diesem Kurs. <br> Die Anwesenheit kann nur direkt am jeweilligen Tag erfasst werden.<br><br>";}

				else
				{
					echo "am ";
					echo date("d.m.Y");
					if ($anzahl==1)
						{
							echo " für die ";
							$row = $statement->fetch();
							echo $row[0];
							echo ". Unterrichtsstunde";
							echo"<input type='hidden' name='stundennr' value='$row[0]'>";
							echo"<input type='hidden' name='wochentag' value='$wochentag'>";
						}
					
					if ($anzahl>1)
						{
							echo " für die ";
							echo "<select name='stundennr'>";   
					
							$i=0;
							while($row = $statement->fetch())
								{
									echo"<option value='".$row[0]."'>".$row[0].". Stunde</option>";
									$all.=$row[0];
									$allval.=$row[0];
									$i=$i+1;
									if($anzahl>$i){$all.=".+";} else {$all.=". Stunde";}
									if($anzahl>$i){$allval.=",";}
									
								}
							echo"<option value='".$allval."'>".$all."</option>";
							echo "</select>";
							echo"<input type='hidden' name='wochentag' value='$wochentag'>";
							
						}
		?>
				
		<div class="table-responsive">
            <table class="table">
                <thead class=" text-primary">
                    <tr>
						<th>#</th>
						<th>Vorname</th>
						<th>Nachname</th>
						<th>Anwesenheit</th>
						</tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
		 
		$statement = $pdo->prepare("SELECT DISTINCT users.id, users.vorname, users.nachname FROM zuordnung_schueler_unterricht INNER JOIN users ON zuordnung_schueler_unterricht.schueler_id=id WHERE zuordnung_schueler_unterricht.unterrichts_id IN($id) ORDER BY users.nachname");
		$result = $statement->execute();	
		$anzahl=1;
		while($row = $statement->fetch()) 
			{
				$schulernr=$row[0];

			    
				$statement2 = $pdo->prepare("SELECT id, schueler_id, begruendung FROM `fehlstunden` WHERE schueler_id=$schulernr AND datum=cast(now()as date)");
				$result2 = $statement2->execute();

				if($statement2->rowCount()==0)
					{
						echo "<tr>";
						echo "<td>".$anzahl."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td class=' td-actions text-left'><select name='fehlstunden[]'>";   
						echo"<option value='0'>anwesend</option>";
						echo"<option value='$row[0]'>fehlend</option>";
						echo "</tr>";
					}
				else 
					{
						echo "<tr class='table-danger'>";
						echo "<td>".$anzahl."</td>";
						echo "<td>".$row[1]."</td>";
						echo "<td>".$row[2]."</td>";
						echo "<td class=' td-actions text-left'><select name=''>";   
						echo"<option value=''>fehlend</option>";
						
						echo "</tr>";
					}
				$anzahl=$anzahl+1;
			}
		
					
?> 


				
						 </tbody></table></div>				
  	
<button class='btn btn-primary btn-block' type='submit'>Eingaben absenden</button>


                </div>
              </div>
			  </form>
            </div>
         
		 

      
      </div>

      <footer class="footer">
        <div class="container-fluid">
          <nav>
            <ul>
              <li>
                <a href="./impressum.php">
                  Impresssum
                </a>
              </li>
              <li>
                <a href="http://reinhard-mohn-berufskolleg.de">
                  Hompage
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright" id="copyright">
            &copy;
            <script>
              document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
            </script>, Designed by
            <a href="https://www.invisionapp.com" target="_blank">Invision</a>. Coded by
            <a href="./#" target="_blank">WG13B</a>.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->

  
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
</body>

</html>
<?php
}}
?>