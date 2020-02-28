<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);

$state = $_GET['state'];

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
  <!--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script-->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
          <li>
            <a href="./overview.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Meine Krankmeldungen</p>
            </a>
          </li>
          <li class="active">
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
            <a class="navbar-brand" href="">Krankmeldung erfassen</a>
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
                

			  
<form method='POST' action='./submit2.php'>
    
    
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Krankmeldung erfassen</h4>
				</div>
			  <div class="card-body">
			  
			  <?php
$wochentag=date("N");

$uhrzeit = date("H:i");
$stundenbeginn = array("08:00", "08:45", "09:45", "10:30", "11:30", "12:15", "13:30", "14:15");

				$statement = $pdo->prepare("SELECT COUNT(unterricht.stundennr) FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND unterricht.archived=0");
	
				$result = $statement->execute();
				
				if ($statement->rowCount()==0)
				{echo "Für heute sind im System keine Unterrichtsstunden für dich eingetragen. <br> Eine Krankmeldung kann nur direkt am jeweilligen Tag erfolgen.<br><br>";}

				else
				{
					
				$statement = $pdo->prepare("SELECT id, schueler_id, begruendung FROM `fehlstunden` WHERE schueler_id=$usernr AND datum=cast(now()as date)");
				$result = $statement->execute();

				if($statement->rowCount()==0)
					{
?> 


				<div class="row">
					<div class="col-md-6">
						

								<table class='table'>
									<thead>
										<tr>
											<th class='text-center'>#</th>
											<th>Fach</th>
											<th>Lehrer</th>
											<th class='text-center'>Auswahl</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$stundennr=1;
										
										while($stundennr<9)
										{
											$statement = $pdo->prepare("SELECT unterricht.stundennr, unterricht.bezeichnung, users.nachname, unterricht.id FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id INNER JOIN users ON unterricht.lehrer_id=users.id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND unterricht.stundennr=$stundennr AND unterricht.archived=0 ORDER BY unterricht.stundennr");
											$result = $statement->execute();	
											
											if($statement->rowCount()==0)
												{
													echo "<tr>";
													echo "<td class='text-center'>".$stundennr."</td>";
													echo "<td>-----</td>";
													echo "<td>-----</td>";
													echo "<td></td>";
													echo "</tr>";
												}
											else
												{
													while($row = $statement->fetch()) 
														{		
															echo "<tr>";
															echo "<td class='text-center'>".$stundennr."</td>";
															echo "<td>".$row[1]."</td>";
															echo "<td>".$row[2]."</td>";
															
															if( $uhrzeit < $stundenbeginn[$stundennr-1])
															{
																echo "<td class='td-actions text-center'><div class='form-check form-check-inline'><label class='form-check-label'><input class='form-check-input' type='checkbox' checked name='fehlstunden[]' value='".$row[3]."'><span class='form-check-sign'></span></label></div></td>";
																echo "</tr>";
															}
															else 
															{
																echo "<td class='td-actions text-center'><div class='form-check form-check-inline'><label class='form-check-label'><input class='form-check-input' type='checkbox' disabled name='fehlstunden[]' value='".$row[3]."'><span class='form-check-sign'></span></label></div></td>";
																echo "</tr>";
															}
														}
												}
											$stundennr=$stundennr+1;	
										}
										?>
									</tbody>
								</table>
					
					</div>
					<div class="col-md-6">
				
								<table class='table'>
									<thead>
										<tr>
											<th>Mitteilung</th>
												</tr>
									</thead>
									<tbody>
										<tr>
											<td class="text-center"><textarea type='text' class='form-control inputFileVisible' name ="fehltext" placeholder="Hier kannst du den Grund für dein Fehlen oder auch die voraussichtliche Dauer eintragen." row='5'></textarea></td>
											</td>
										</tr>
									</tbody>
								</table>
</div>
</div>
				<div class="row">
					<div class="col-md-6">
						

							
							<table class='table'>
									<thead>
										<tr>
											<th>Attest</th>
												</tr>
									</thead>
									<tbody>
										<tr>
										
											<td><input id="inp_file" type="file"></td>
											<td><input id="inp_img" name="img" type="hidden" value=""></td>
										</td>
										</tr>
									</tbody>
								</table>

						
					</div>
					<div class="col-md-6">
												<table class='table'>
									<thead>
										<tr>
											<th>&nbsp;</th>
												</tr>
									</thead>
									<tbody>
										<tr>
										
											<td>								
											
											
										<?php
											$statement = $pdo->prepare("SELECT attestpflicht FROM users WHERE id=$usernr");
											$result = $statement->execute();	
											while($row = $statement->fetch()) 
												{		
													if($row[0]==0)
														{
															echo"<div class='alert alert-info alert-with-icon' data-notify='container'>";	
															echo"<span data-notify='icon' class='now-ui-icons travel_info'></span>";	
															echo"<span data-notify='message'>Wenn dir noch kein Attest vorliegt, kannst du dieses auch nachträglich unter 'meine Krankmeldungen' hochladen.</span>";
															echo"</div>";
														}
													else
														{
															echo"<div class='alert alert-danger alert-with-icon' data-notify='container'>";	
															echo"<span data-notify='icon' class='now-ui-icons travel_info'></span>";	
															echo"<span data-notify='message'>Du unterliegst zur Zeit der Attestpflicht. Ein Attest ist bei jedem Fehlen mit hochzuladen. Du kannst dein Attest jedoch auch nachträglich unter 'meine Krankmeldungen' hochladen.</span>";
															echo"</div>";
														}
												}
										?>											
								</td>
										</tr>
									</tbody>
								</table>

							</div>
						</div>
				
				<div class="row">
					<div class="col-md-12">
					
								<button class='btn btn-primary btn-block' type='reset'>Eingaben zurücksetzen</button><br>
								<button class='btn btn-primary btn-block' type='submit'>Eingaben absenden</button>
				
					</div>
				</div>	
				        </div>
          </div>
		</div>
	  </div>
</form>
				<?php
						}
						else
						{
						echo "Du hast heute schon eine Krankmeldung abgegeben.";
						}
				}
					
				?>
    
    </div>  
  </div>
</div>

  <!--   Core JS Files   -->
  
  <script>
 
  function fileChange(e) { 
     document.getElementById('inp_img').value = '';
     
     var file = e.target.files[0];
 
     if (file.type == "image/jpeg" || file.type == "image/png") {
 
        var reader = new FileReader();  
        reader.onload = function(readerEvent) {
   
           var image = new Image();
           image.onload = function(imageEvent) {    
              var max_size = 640;
              var w = image.width;
              var h = image.height;
             
              if (w > h) {  if (w > max_size) { h*=max_size/w; w=max_size; }
              } else     {  if (h > max_size) { w*=max_size/h; h=max_size; } }
             
              var canvas = document.createElement('canvas');
              canvas.width = w;
              canvas.height = h;
              canvas.getContext('2d').drawImage(image, 0, 0, w, h);
                 
              if (file.type == "image/jpeg") {
                 var dataURL = canvas.toDataURL("image/jpeg", 1.0);
              } else {
                 var dataURL = canvas.toDataURL("image/png");   
              }
              document.getElementById('inp_img').value = dataURL;   
           }
           image.src = readerEvent.target.result;
        }
        reader.readAsDataURL(file);
     } else {
        document.getElementById('inp_file').value = ''; 
        alert('Bitte wählen Sie ein Bild im JPG- oder PNG-Format aus.');    
     }
  }
 
  document.getElementById('inp_file').addEventListener('change', fileChange, false);    

</script>

        
<script>

if (<?php echo json_encode($state);?>==1)
	{
  swal({
                    text: "Die Fehlstunden und das Attest wurden erfolgreich übermittelt.",
                    icon: "success"
                    });
	}
	
	

if (<?php echo json_encode($state);?>==2)
	{
  swal({
                    text: "Die Fehlstunden wurden übermittelt. Das Attest könnte jedoch nicht verarbeitet werden. Bitte unter 'meine Krankmeldungen' nachträglich hochladen.",
                    icon: "error"
                    });
	}

if (<?php echo json_encode($state);?>==3)
	{
  swal({
                    text: "Die Fehlstunden wurden erfolgreich übermittelt.",
                    icon: "success"
                    });
	}

if (<?php echo json_encode($state);?>==4)
	{
  swal({
                    text: "Fehler. Es wurden keine Fehlstunden ausgewählt.",
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