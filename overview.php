<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$state = $_GET['state'];


if(isset($_POST['info'])) 
	{
		 $test="vom ".$_POST['info']."<table class='table'><thead><tr><th>#</th><th>Fach</th><th>Lehrer</th></tr></thead><tbody>";
										$statement = $pdo->prepare("SELECT unterricht.stundennr, unterricht.bezeichnung, users.nachname, fehlstunden.status FROM fehlstunden INNER JOIN unterricht ON fehlstunden.unterrricht_id=unterricht.id INNER JOIN users ON unterricht.lehrer_id=users.id WHERE fehlstunden.schueler_id=$usernr AND datum = '".$_POST['info']."'");
											$result = $statement->execute();	
											while($row = $statement->fetch()) 
												{		
													$test.="<tr>";
													$test.="<td class='text-center'>".$row[0]."</td>";
													$test.="<td>".$row[1]."</td>";
													$test.="<td>".$row[2]."</td>";
													$test.="</tr>";
												}
									$test.="</tbody></table>";
									echo"<body onload='details()'>";
	}
	
if(isset($_POST['attest'])) 
	{
		$file="attests/".$usernr."-".$_POST['attest'].".jpg";
		$caption='vom '.$_POST['attest'];
		
		if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) 
			{
				echo"<body onload='showattest()'>";
			} 
		else 
			{

				echo"<body onload='uploadattest()'>";
			}
	}	
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
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
 
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="orange">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="./dashboard.php" class="simple-text logo-mini">
          <img src="./logo_rmb.png">
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
          <li class="active">
            <a href="./overview.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Meine Krankmeldungen</p>
            </a>
          </li>
          <li>
            <a href="./submit.php">
              <i class="now-ui-icons ui-1_simple-add"></i>
              <p>Krankmeldung erfassen</p>
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
            <a class="navbar-brand" href="">Meine Krankmeldungen</a>
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
                <a class="nav-link" href="./logout.php">
                  <i class="now-ui-icons users_single-02"></i>
                  <p>logout
                    <span class="d-lg-none d-md-block"></span>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">

              <div class="card-header">
                <h4 class="card-title">Fehltage:</h4>
                 
              </div>
              <div class="card-body">
			  <form action="" method="post">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
	<th>Datum</th>
	<th>Fehlstunden</th>
	<th>Kommentar</th>
	<th>Status</th>
	</tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
     $fehltage = array();
	 $anzahl=0;
     $statement = $pdo->prepare("SELECT DISTINCT datum FROM `fehlstunden` WHERE schueler_id=$usernr");
     $result = $statement->execute();

         
         while($row = $statement->fetch())
         { 
               $fehltage[$anzahl]=$row[0];
			   $anzahl=$anzahl+1;
         }
		 
		 $anzahl2=0;
		 while ($anzahl2<$anzahl)
		 {
		 $statement = $pdo->prepare("SELECT DISTINCT DATE_FORMAT(datum,'%d.%m.%Y'), COUNT(unterrricht_id), begruendung, status, datum FROM `fehlstunden` WHERE schueler_id=$usernr AND datum = '".$fehltage[$anzahl2]."'");
				
				$result = $statement->execute();
				$anzahl2=$anzahl2+1;
				
				while($row = $statement->fetch()) 
				{
					
					echo"<tr>";
					
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					
					if ($row[3]==0){echo "<td>Nicht geprüft</td>";}
					if ($row[3]==1){echo "<td>Entschuldigt</td>";}
					if ($row[3]==2){echo "<td>Unentschuldigt</td>";}
					
					echo"<td class='td-actions text-right'>";
					echo"<button type='submit' name='info' value=".$row[4]." class='details btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Details'><i class='now-ui-icons ui-1_zoom-bold'></i></button>";
					echo"<button type='submit' name='attest' value=".$row[4]." class='attest btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Attest'><i class='now-ui-icons files_single-copy-04'></i></button>";
					
					echo"</td>";
					echo "</tr>";
		 }}
     ?>

                    </tbody>
                  </table>
                </div>
				</form>
              </div>
            </div>
              </div>
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
  
  <SCRIPT>
function details()
{
	swal({title:"Fehlstunden", html: <?php echo json_encode($test); ?>,onDestroy: 'true'});
}
</script>
<script>
function showattest()
{
 swal({
  title: 'Attest',
  text: <?php echo json_encode($caption); ?>,
  imageUrl: <?php echo json_encode($file); ?>,
  imageWidth: 400,
  imageAlt: 'Attest',
})

}
</SCRIPT>
<script>
function uploadattest()
{
swal({
  title: 'Attest',
  text: "Bislang wurde noch kein Attest hochgeladen.",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Attest hochladen'
}).then((result) => {
  if (result.value) {
   window.location = "../submit3.php?date="+<?php echo json_encode($_POST['attest']); ?>+"";
  }
})

}
</SCRIPT>

<script>

if (<?php echo json_encode($state);?>==1)
	{
  swal({
                    text: "Das Attest wurde erfolgreich übermittelt.",
                    icon: "success"
                    });
	}
	
	

if (<?php echo json_encode($state);?>==2)
	{
  swal({
                    text: "Das Attest konnte nicht verarbeitet werden. Bitte erneut versuchen.",
                    icon: "error"
                    });
	}
</script>

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