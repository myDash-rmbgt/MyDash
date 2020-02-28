<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll
 
if(isset($_GET['register'])) {
	$error = false;
	$einmalkey = trim($_POST['einmalkey']);
	$einmalpass = trim($_POST['einmalpass']);
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
	$email = trim($_POST['email']);
	$passwort = $_POST['passwort'];
	$passwortwh = $_POST['passwortwh'];
	$agreement = $_POST['agreement'];
	
	
	//Überprüfe, dass die Passwörter übereinstimmen
	if($passwort != $passwortwh) {
		$meldung=5;
		$error = true;
	}
	
	//Überprüfen, ob mit Nutzerrichtlinien einverstanden
		if($agreement != "agreement") {
		$meldung=6;
		$error = true;
	}
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();
		
		if($user !== false) {
			
			$meldung=1;
			$error = true;
		}	
	}
	
		//Überprüfe, dass der Einmalkey mit dem Einmalpass übereinstimmt
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE einmalkey = '$einmalkey' AND einmalpass = '$einmalpass'");
		$result = $statement->execute();
		$user = $statement->fetch();
		
		if($user == false) {
			$meldung=2;
			$error = true;
		}	
	}
	
	
	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {	
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
		
		$statement = $pdo->prepare("UPDATE users SET email='$email', passwort='$passwort_hash', vorname='$vorname', nachname='$nachname' WHERE einmalkey='$einmalkey'");
		$result = $statement->execute();
		
		if($result) {		
			$meldung=4;
		
		} else {
			$meldung=3;
		}
	} 
}
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    myDASH - RMBGT
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="offline-doc">
   <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
    <div class="container">
      <div class="navbar-wrapper">

        <a class="navbar-brand" >myDASH - RMBGT</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="https://www.reinhard-mohn-berufskolleg.de/">
              Homepage
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./kontakt.php">
              Kontakt
            </a>
          </li>
		            <li class="nav-item">
            <a class="nav-link" href="./login.php">
              Login
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->
 <form action="?register=1" method="post">
  <div class="page-header clear-filter" filter-color="orange">
    <div class="page-header-image" style="background-image: url('./assets/img/header.jpg');"></div>
    <div class="container text-center">
      <div class="row">
	  <div class="col-md-12 ml-auto mr-auto">
        <div class="brand">
         
          <div class="container form-signin">
	<br>
	<br>
	
	

        </div>
      </div>
	  </div>
	  
	  <!--- ......................................... -->
	<div class="col-md-12">
	 <h1 class="title">
            myDASH - RMBGT
          </h1>
		  <h2>Registrieren</h2>
		  </div>
	
	
	  <div class="col-md-6">
        


















<div class="card ">
    
    
    <div class="card-body ">
        

        

        

        
              <div class="form-horizontal">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Einmalkey</label>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="einmalkey" type="text" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Einmalpass</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="einmalpass" type="password" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Vorname</label>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="vorname" type="text" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <label class="col-md-3 col-form-label">Nachname</label>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="nachname" type="text" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                   
                               </div>
    
    </div>
	
	    <div class="card-footer ">
    
    </div>
    
</div>



















    </div>
	  
	   <div class="col-md-6">
        


















<div class="card ">
    
    
    <div class="card-body ">
        

        

        

        
              <div class="form-horizontal">
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Email</label>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name ="email" type="email" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Passwort</label>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="passwort" type="password" required="true" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <label class="col-md-3 col-form-label">Passwort</label>

                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <input name="passwortwh" type="password" required="true" placeholder="wiederholen" class="form-control">
                                            </div>
                                        </div>
                                    </div>
									
									
									
									<div class="row">
									<div class="form-check mt-3">
                                    <label class="form-check-label">
                                        <input name="agreement" value="agreement" class="form-check-input" type="checkbox">
                                        <span class="form-check-sign"></span>
                                        Mit den <a href="./nutzerrichtlinien.php" target="_blank">Nutzungsrichtlinien</a> bin ich einverstanden.
                                    </label>
                                </div>
								</div>
								
                                   
                                </div>
        

        
    </div>
    
    
    
    <div class="card-footer ">
        <div class="row">
                            <label class="col-md-3"></label>

                            <div class="col-md-9">
                                <button type="submit" class="btn btn-fill btn-primary">Registrieren</button>
                            </div>
                        </div>
    </div>
    
</div>



    </div>
	




	
	  
    </div>
  </div>
   </div>
   </form>

 <footer>
 </footer>

  
  <script>
  if (<?php echo json_encode($meldung);?>==1)
	{
  swal({
                    text: "Fehler. Diese Emailadresse ist bereits registriert.",
                    icon: "error"
                    });
	}
	
	if (<?php echo json_encode($meldung);?>==2)
	{
  swal({
                    text: "Fehler. Der Einmalkey und der Einmalpass sind nicht angelegt.",
                    icon: "error"
                    });
	}

	if (<?php echo json_encode($meldung);?>==3)
	{
  swal({
                    text: "Fehler. Beim Abspeichern ist leider ein Fehler aufgetreten.",
                    icon: "error"
                    });
	}
	
	if (<?php echo json_encode($meldung);?>==4)
	{
  swal({
                    icon: "success",
					text: "Registrierung erfolgreich. Du wirst nun zum Login weitergeleitet."
					
                    });
					window.setTimeout('window.location = "./login.php"',2000);
	}	

	if (<?php echo json_encode($meldung);?>==5)
	{
  swal({
                    text: "Fehler. Die Passwörter stimmen nicht überein.",
					icon: "error"
                    });
	}

	if (<?php echo json_encode($meldung);?>==6)
	{
  swal({
                    text: "Fehler. Den Nutzerrichtlinien muss zugestimmt werden.",
					icon: "error"
                    });
	}	
</script>


  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js"></script>
  <script src="./assets/js/core/popper.min.js"></script>
  <script src="./assets/js/core/bootstrap.min.js"></script>
  <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="./assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="./assets/demo/demo.js"></script>
</body>
</html>