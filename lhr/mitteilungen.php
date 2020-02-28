<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$usertyp = ($user['typ']);
$state = $_GET['state'];

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
          <li>
            <a href="./courses.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Meine Kurse</p>
            </a>
          </li>
          <li  class="active">
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
            <a class="navbar-brand" href="">Mitteilungen</a>
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
          <div class="col-md-12">
            <div class="card">
		 <div class="card-body">
		
<h4>Krankmeldungen</h4>  
<h6>zur Freigabe ausstehend:</h6>
			  
			  <form action="./mitteilungen2.php" method="post">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
	<th>#</th>
	<th>Vorname</th>
	<th>Nachname</th>
	<th>Klasse</th>
	<th>Datum</th>
	<th></th>
	<th></th>
	</tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
		 
echo "<form action='' method='post'>";		//Virtuelles Form
echo "</form>";
			
		$statement = $pdo->prepare("SELECT users.id, users.vorname, users.nachname, klassen.klassen_bezeichnung, fehlstunden.datum, fehlstunden.begruendung, fehlstunden.attestname, COUNT(fehlstunden.id), users.attestpflicht FROM fehlstunden INNER JOIN users ON users.id=fehlstunden.schueler_id INNER JOIN klassen ON klassen.id=users.klassen_id WHERE fehlstunden.status=0 AND klassen.lehrer_id=$usernr GROUP BY users.id, datum ORDER BY users.id, datum");
		$result = $statement->execute();
		
		$anzahl=1;
		while($row = $statement->fetch()) 
			{
				$schulernr=$row[0];
				echo "<tr>";
				echo "<td>".$anzahl."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[3]."</td>";
				echo "<td>".$row[4]."</td>";
				
				echo "<form action='' method='post'>";
				
				echo "<td class='td-actions text-right'>";
				echo "<input type='hidden' name='schuelerdetails' value='".$row[0]."'>";
				if(strlen($row[5])>0)
					{echo "<button type='submit' name='begruendung' value='".$row[5]."' class='attest btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Begruendung'><i class='now-ui-icons text_bold'></i></button>";}
				echo "<button type='submit' name='info' value=".$row[4]." class='details btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Details'><i class='now-ui-icons ui-1_zoom-bold'></i></button>";
				
				if($row[8]=="1")
					{echo "<button type='submit' name='attest' value=".$row[4]." class='attest btn btn-info btn-round btn-icon btn-icon-mini btn-danger' data-original-title='Attest'><i class='now-ui-icons files_single-copy-04'></i></button>";}
				else
					{echo "<button type='submit' name='attest' value=".$row[4]." class='attest btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Attest'><i class='now-ui-icons files_single-copy-04'></i></button>";}
				
				echo "</form>";	
				echo "</td>";
				echo "<td><select name='aktion[]'>";   
				echo "<option value='0,".$row[0].",".$row[4]."'>nicht bearbeitet</option>";
				echo "<option value='1,".$row[0].",".$row[4]."'>entschuldigt</option>";
				echo "<option value='2,".$row[0].",".$row[4]."'>unentschuldigt</option>";
				echo "</tr>";
				$anzahl=$anzahl+1;
		 }
		 
		 
		 
		 ?>
		 
		
		 
		 </tbody></table></div> 
		<button name="absenden" class="btn btn-primary btn-block" type="submit">Eingaben absenden</button>
		 </form></div></div></div></div>
	  
	
	   <?php
  
  if(isset($_POST['info'])) 
	{

		 $test="vom ".$_POST['info']."<table class='table'><thead><tr><th>#</th><th>Fach</th><th>Lehrer</th></tr></thead><tbody>";
										$statement = $pdo->prepare("SELECT unterricht.stundennr, unterricht.bezeichnung, users.nachname, fehlstunden.status FROM fehlstunden INNER JOIN unterricht ON fehlstunden.unterrricht_id=unterricht.id INNER JOIN users ON unterricht.lehrer_id=users.id WHERE fehlstunden.schueler_id='".$_POST['schuelerdetails']."' AND datum = '".$_POST['info']."'");
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
		$file="/attests/".$_POST['schuelerdetails']."-".$_POST['attest'].".jpg";
		$caption='vom '.$_POST['attest'];
		
		if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) 
			{
				echo"<body onload='showattest()'>";
			} 
		else 
			{

				echo"<body onload='noattest()'>";
			}
	}
	
	  if(isset($_POST['begruendung'])) 
	{
			$begruendung=$_POST['begruendung'];
				echo"<body onload='begruendung()'>";
			
	}
	
	
		 ?>
		 
		 
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
  
  <script>
function details()
{
	swal({title:"Fehlstunden", html: <?php echo json_encode($test); ?>,onDestroy: 'true'});
}
</script>

  <script>
function begruendung()
{
	swal({title:"Kommentar", text: <?php echo json_encode($begruendung); ?>,onDestroy: 'true'});
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
function noattest()
{
swal({
  title: 'Attest',
  text: "Bislang wurde noch kein Attest hochgeladen.",
  icon: 'warning',
})

}
</SCRIPT>

<script>

if (<?php echo json_encode($state);?>==1)
	{
  swal({
                    text: "Ihre Angaben wurden erfolgreich übermittelt.",
                    icon: "success"
                    });

window.setTimeout('window.location = "/lhr/mitteilungen.php?state=0"',2000);
	}
</SCRIPT>

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
}
?>