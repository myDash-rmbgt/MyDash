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
            <a class="navbar-brand" href="">Meine Kurse</a>
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
		<form action="" method="post">
            <div class="card">
              <div class="card-body">
               
			  Auswahl:
			       
				   <div class="btn-group">
                    
					<?php
					
					$statement = $pdo->prepare("select group_concat(ids) as ids,group_concat(klassen_bezeichnung) as klassen_bezeichnung,lehrer_id, bezeichnung, wochentag_stundennr from (select l.klassen_id, c.klassen_bezeichnung as klassen_bezeichnung,l.lehrer_id, l.bezeichnung, group_concat(l.wochentag, ':', l.stundennr order by l.wochentag, l.stundennr) as wochentag_stundennr,group_concat(l.id order by l.id) as ids from unterricht l join klassen c on l.klassen_id = c.id group by l.klassen_id, c.klassen_bezeichnung, l.lehrer_id, l.bezeichnung ) l WHERE lehrer_id=$usernr group by lehrer_id, wochentag_stundennr;");
					$result = $statement->execute();	
					if($statement->rowCount()==0)
						{
							echo "noch keine Kurse vorhanden";
						}
					else
						{
							while($row = $statement->fetch()) 
								{		
									
									echo"<button type='submit' name='auswahl' value='".$row[0].".".$row[3]." ".$row[1]."' class='btn btn-round btn-primary'>".$row[3]." ".$row[1]."</button>";
								}
						}
					?>
					</div>
                </div>
              </div>
			  </form>
            </div>
         
		 
		 <?php
		  
	 
    if(isset($_POST['auswahl'])) 
	{
		list($idklasse, $bez) = explode(".", $_POST['auswahl']);
		?>
		     <div class="col-md-12">
            <div class="card">
              <div class="card-body">
			  
			  
			 
			  	
					
<h4>Kursliste</h4>
			 <form action="./courses2.php" method="post">
			
<?php 
echo"<input type='hidden' name='bez' value='$bez'>";
echo"<button type='submit' name='id' value='$idklasse' class='btn btn-primary btn-round'>Anwesenheit erfassen</button>";
?>

			</form>
			  
			  
			  <form action="" method="post">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
	<th>#</th>
	<th>Vorname</th>
	<th>Nachname</th>
	<th>Kursfehlstunden</th>
	<th></th>
	<th></th>
	</tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php
		 
		$statement = $pdo->prepare("SELECT DISTINCT users.id, users.vorname, users.nachname FROM zuordnung_schueler_unterricht INNER JOIN users ON zuordnung_schueler_unterricht.schueler_id=id WHERE zuordnung_schueler_unterricht.unterrichts_id IN($idklasse) ORDER BY users.nachname");
		$result = $statement->execute();	
		$anzahl=1;
		while($row = $statement->fetch()) 
			{
				$schulernr=$row[0];
				echo "<tr>";
				echo "<td>".$anzahl."</td>";
				echo "<td>".$row[1]."</td>";
				echo "<td>".$row[2]."</td>";
			    echo "<form action='' method='post'>";
				
				$statement2 = $pdo->prepare("SELECT COUNT(id), COUNT(IF(status=2,1,NULL)) FROM fehlstunden WHERE schueler_id=$row[0] AND unterrricht_id IN($idklasse)");
					
				$result2 = $statement2->execute();
				while($row2 = $statement2->fetch()) 
					{
						echo"<td>$row2[0] ($row2[1])</td>";
					}
				
				echo"<td class='td-actions text-right'>";
				echo"<input type='hidden' name='idklasse' value='".$idklasse."'>";
				echo"<input type='hidden' name='schuelername' value='".$row[1]." ".$row[2]."'>";
				echo"<button type='submit' name='schuelerdetails' value='".$row[0]."' class='details btn btn-info btn-round btn-icon btn-icon-mini btn-neutral' data-original-title='Details'><i class='now-ui-icons arrows-1_minimal-down'></i></button>";
				echo"</td>";
				echo "</tr>";
				echo "</form>";
				$anzahl=$anzahl+1;
		 }
		 echo"</tbody></table></div></form></div></div></div>";
     
	}
	
	?>
		
	
 <?php
    if(isset($_POST['schuelerdetails'])) 
	{
		$schuelername=$_POST['schuelername'];
		$schuelerdeatails=$_POST['schuelerdetails'];
		$idklasse=$_POST['idklasse'];
		$show=1;
	?>
		    			  <div class="col-md-12">
            <div class="card">
              <div class="card-body">
			  
			  
			 
			
			 <div class="table-responsive">
                  <table class="table">

                    <tbody>
                      <tr>
                        <?php
					echo"<tr>";
					
					echo "<td><h4>";
					echo $schuelername;
					echo "</h4></td>";
					echo "</tr>";
						?>
                    </tbody>
                  </table>
				 
                </div>
				
			  <form action="" method="post">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <tr>
	<th>Datum</th>
	<th>Kursfehlstunden</th>
	<th>Kommentar</th>
	<th>Status</th>
	</tr>
                    </thead>
                    <tbody>
                      <tr>
                        <?php

     $fehltage = array();
	 $anzahl=0;
     $statement = $pdo->prepare("SELECT DISTINCT datum FROM `fehlstunden` WHERE unterrricht_id IN(".$idklasse.") AND schueler_id=".$_POST['schuelerdetails']);
     $result = $statement->execute();
 
         while($row = $statement->fetch())
         { 
               $fehltage[$anzahl]=$row[0];
			   $anzahl=$anzahl+1;
         }
		 
		 $anzahl2=0;
		 while ($anzahl2<$anzahl)
		 {
		 $statement = $pdo->prepare("SELECT DISTINCT DATE_FORMAT(datum,'%d.%m.%Y'), COUNT(unterrricht_id), begruendung, status, datum FROM `fehlstunden` WHERE schueler_id='".$_POST['schuelerdetails']."' AND unterrricht_id IN(".$idklasse.") AND datum = '".$fehltage[$anzahl2]."'");
				
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
					echo"<input type='hidden' name='schuelername' value='".$_POST['schuelername']."'>";
					echo"<input type='hidden' name='schuelerdetails' value='".$_POST['schuelerdetails']."'>";
					echo"<input type='hidden' name='idklasse' value='".$_POST['idklasse']."'>";
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
  <?php
		
	

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

<script>
function details()
{
	swal({title:"Kursfehlstunden", html: <?php echo json_encode($test); ?>,onDestroy: 'true'});
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
function loeschen()
{
swal({
  title: 'Schüler entfernen',
  text: "Sind Sie sicher, dass Sie diesen Schüler löschen möchten?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Schüler entfernen'
}).then((result) => {
  if (result.value) {
   window.location = "./classes3.php?id="+<?php echo json_encode($_POST['loeschen']); ?>+"";
  }
})
}
</SCRIPT>

<script>
function reset()
{
swal({
  title: 'Fehlstunden zurücksetzen',
  text: "Sind Sie sicher, dass Sie alle Fehlstunden für diesen Schüler löschen möchten?",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Fehlstunden zurücksetzen'
}).then((result) => {
  if (result.value) {
   window.location = "./classes2.php?id="+<?php echo json_encode($_POST['reset']); ?>+"";
  }
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

window.setTimeout('window.location = "/lhr/courses.php"',2000);
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