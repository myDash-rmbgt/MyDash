<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$state = $_GET['state'];
$uservorname = ($user['vorname']);
$usernachname = ($user['nachname']);

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
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <img src="./logo_rmb.png">
        </a>
        <a href="./dashboard.php" class="simple-text logo-normal">
          myDASH - RMBGT
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="./dashboard.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
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
    
            
          <!-- Full Page Intro -->
          <div class="view" style="background-image: url('back.jpg'); background-repeat: no-repeat; opacity: 0.5; height: 400px; background-size: cover; background-position: center center;">
            <!-- Mask & flexbox options-->
            <div class="mask rgba-gradient align-items-center">
              <!-- Content -->
              <div class="container">
                <!--Grid row-->
                
				<div class="row">
				<h1>&nbsp; <h1>
				</div>
				
				<div class="row">
                  <!--Grid column-->
                  
				  <div class="col-md-6 white-text text-center text-md-left mt-xl-3 mb-3">
                    <h1 class="h2-responsive font-weight-bold mt-sm-4">Willkommen,  <?php echo $uservorname;?>&nbsp;<?php echo $usernachname; ?></h1>
                  </div>
                  <!--Grid column-->
                  <!--Grid column-->
                  <div class="col-md-6 col-xl-4 mt-xl-5 wow fadeInRight">
                    <img src="/overlay.png" alt="" class="img-fluid">
                  </div>
                  <!--Grid column-->
                </div>
                <!--Grid row-->
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
      
     
 
	   
	   
	   
	 
	   
      <div class="content">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Heutiger</h5>
                <h4 class="card-title">Stundenplan</h4>
              </div>
              <div class="card-body">
                								
										<?php

										$wochentag=date("N");
										$statement = $pdo->prepare("SELECT COUNT(unterricht.stundennr) FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND archived=0");
										$result = $statement->execute();
				
										while($row = $statement->fetch()) 
											{
												if ($row[0]==0)
												{echo "Für heute sind keine Unterrichtsstunden hinterlegt.";}

												else
													{
										
										echo "<table class='table'><thead><tr><th class='text-center'>#</th><th>Fach</th><th>Lehrer</th></tr></thead><tbody>";
										$stundennr=1;
										
										while($stundennr<9)
										{
											$statement = $pdo->prepare("SELECT unterricht.bezeichnung, users.nachname, unterricht.id FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id INNER JOIN users ON unterricht.lehrer_id=users.id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND unterricht.stundennr=$stundennr AND archived=0");
											$result = $statement->execute();	
													
													if($statement->rowCount()==0)
													{
													echo "<tr>";
													echo "<td class='text-center'>".$stundennr."</td>";
													echo "<td>-----</td>";
													echo "<td>-----</td>";
													echo "</tr>";
													}
													
													else
													{
														while($row = $statement->fetch()) 
														{
															echo "<tr>";
															echo "<td class='text-center'>".$stundennr."</td>";
															echo "<td>".$row[0]."</td>";
															echo "<td>".$row[1]."</td>";
															echo "</tr>";
														}	
													}
												
											$stundennr=$stundennr+1;
										}
											}}
										?>
									</tbody>
								</table>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Anzahl</h5>
                <h4 class="card-title">Fehlstunden</h4>
              </div>
              <div class="card-body">
				<h1><center>
			  
			  	<?php
				$statement = $pdo->prepare("SELECT COUNT(id) FROM fehlstunden WHERE schueler_id=$usernr");
				$result = $statement->execute();
				while($row = $statement->fetch()) 
						{
							echo $row[0];
						}
				?>
			  
				</center></h1>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">davon</h5>
                <h4 class="card-title">Unentschuldigt</h4>
              </div>
              <div class="card-body">
				
				
				<?php
				$statement = $pdo->prepare("SELECT COUNT(id) FROM fehlstunden WHERE schueler_id=$usernr AND status=2");
				$result = $statement->execute();
				while($row = $statement->fetch()) 
						{
							if($row[0]==0)
							{
								echo "<div class='text-success'><h1><center>";
								echo $row[0];
								echo "</center></h1>";
							}
							
							else
							{
								echo "<div class='text-danger'><h1><center>";
								echo $row[0];
								echo "</center></h1>";
							}
						}
				?>
					
				</div>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="now-ui-icons arrows-1_refresh-69"></i> Just Updated
                </div>
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
  <script>

if (<?php echo json_encode($state);?>==1)
	{
  swal({
                    text: "Deine Angaben wurden erfolgreich übermittelt",
                    icon: "success"
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