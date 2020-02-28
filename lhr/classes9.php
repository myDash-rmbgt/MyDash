<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");

//Überprüfe, dass der User eingeloggt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
$usernr = ($user['id']);
$usertyp = ($user['typ']);
$useremail = ($user['email']);

//http://www.selfphp.de/code_snippets/code_snippet.php?id=78
function generatePassword ( $passwordlength = 6,
                            $numNonAlpha = 0,
                            $numNumberChars = 0,
                            $useCapitalLetter = false ) {
    
    $numberChars = '123456789';
    $specialChars = '!$%&=?*-:;.,+~@_';
    $secureChars = 'abcdefghjkmnpqrstuvwxyz';
    $stack = '';
        
    // Stack für Password-Erzeugung füllen
    $stack = $secureChars;
    
    if ( $useCapitalLetter == true )
        $stack .= strtoupper ( $secureChars );
        
    $count = $passwordlength - $numNonAlpha - $numNumberChars;
    $temp = str_shuffle ( $stack );
    $stack = substr ( $temp , 0 , $count );
    
    if ( $numNonAlpha > 0 ) {
        $temp = str_shuffle ( $specialChars );
        $stack .= substr ( $temp , 0 , $numNonAlpha );
    }
        
    if ( $numNumberChars > 0 ) {
        $temp = str_shuffle ( $numberChars );
        $stack .= substr ( $temp , 0 , $numNumberChars );
    }
            
        
    // Stack durchwürfeln
    $stack = str_shuffle ( $stack );
        
    // Rückgabe des erzeugten Passwort
    return $stack;
    
}

	
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
          <li class="active">
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
		<form action="" method="post">
            <div class="card">
              <div class="card-body">
               
			 <h4>Neue Klasse anlegen</h4>
			 
			
			 	 
			 <label>Neuer Klassenname</label>
                <div class="form-group">
                    <input name='newklassenname' type="text" class="form-control">
                </div>
				
				<label>Anzahl der Schüler</label>
                <div class="form-group">
                    <input name='schueleranzahl' type="number" min="1" max="40" class="form-control">
                </div>
				
			<button class='btn btn-primary btn-block' type='submit'>Eingaben absenden</button>
                </div>
              </div>
			  </form>
            </div>
         
		 
		 <?php
		 
		  if((isset($_POST['newklassenname']))&&(isset($_POST['schueleranzahl'])))
	{
			$statement = $pdo->prepare("INSERT INTO klassen (klassen_bezeichnung, lehrer_id) VALUES ('".$_POST['newklassenname']."', '$usernr')");
			$result = $statement->execute();	
			$statement->fetch();
			$klassenid = $pdo->lastInsertId();
			
			
			$schueleranzahl=$_POST['schueleranzahl'];
			$i=1;
			
			$mailtext = '<html>
<head>
    <title>Anmeldedaten für '.$_POST['newklassenname'].'</title>
</head>
 
<body>
 
<h1>Anmeldedaten für '.$_POST['newklassenname'].'</h1>
 
<p>Geben Sie jedem Ihrer Schüler einen Einmalkey mit dem entsprechenden Einmalpass. Mit diesem können die Schüler sich registrieren.</p>
 
<table border="1">
  <tr>
    <td>#</td>
    <td>Einmalkey</td>
	<td>Einmalpass</td>
  </tr>';
  
			
			while($i<($schueleranzahl+1))
				{
					$einmalkey = generatePassword ( 6, 0, 0, false );
					$einmalpass = generatePassword ( 6, 2, 2, true );
					
					$mailtext.='<tr><td>';
					$mailtext.=$i;
					$mailtext.='</td><td>';
					$mailtext.=$einmalkey;
					$mailtext.='</td><td>';
					$mailtext.=$einmalpass;
					$mailtext.='</td></tr>';
					
					$statement = $pdo->prepare("INSERT INTO users (einmalkey, einmalpass, klassen_id) VALUES ('$einmalkey', '$einmalpass', '$klassenid')");
					$result = $statement->execute();	
					$statement->fetch();
					$i=$i+1;
				}
				
			

  
$mailtext.= '
</table>
 
<p>Diese Email wurde automatisch generiert, antworten Sie nicht darauf.</p>
 
</body>
</html>';
 
$empfaenger = $useremail;
$absender   = "mydash@rmbgt.de";
$betreff    = "Anmeldedaten für Ihre Klasse";
$antwortan  = "mydash@rmbgt.de";
 
$header  = "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html; charset=utf-8\r\n";
 
$header .= "From: $absender\r\n";
$header .= "Reply-To: $antwortan\r\n";
$header .= "X-Mailer: PHP ". phpversion();
 
mail( $empfaenger,
      $betreff,
      $mailtext,
      $header);

	echo '<meta http-equiv="refresh" content="0; URL=./classes.php?state=6">';	
	}
		 ?>
  	
      
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
}
?>