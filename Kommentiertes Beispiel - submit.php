<?php
session_start();									//Die Session-ID wird abgerufen, um Benutzer zu indentifizieren (Login)
require_once("inc/config.inc.php");					//Datei mit Zugangsdaten für Datenbank wird eingebunden
require_once("inc/functions.inc.php");				//Datei mit Login-Funktion wird eingebunden

$user = check_user();								//Die Funktion check_user wird in der zuvor eingebundenen Datei aufgerufen, um zu prüfen, ob der Benutzer eingeloggt ist
$usernr = ($user['id']);							//Die übergebene Usernr (aus der Datenbank) wird in der Variable gespeichert
$state = $_GET['state'];							//State ist ein Zwischenspeicher für Rückgabewerte (siehe unten Sweetalert)

?>

<!DOCTYPE html>										<!-- Ab hier startet das Bootstrap-Theme, der header ist auf vielen Webseiten nahezu identisch-->
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    myDASH - RMBGT																														<!-- Titel der Website -->
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />									  	<!--	Schriftarten und Icons werden extern eingebunden	-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />																	  	<!--	CSS Dateien werden eingebunden	-->
  <link href="../assets/css/now-ui-dashboard.css?v=1.3.0" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>														  	<!-- JavaScript-Bibliothek wird eingebunden-->
</head>

<body class="">																	<!-- Ab hier startet der Body des Bootstrap-Theme, auch dieser ist auf vielen Webseiten nahezu identisch-->
  <div class="wrapper">
    <div class="sidebar" data-color="orange">									<!-- Navebar -->
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
          <li>																	<!-- Hier werden die einzelnen Seiten jeweils verlinkt -->																	
            <a href="./dashboard.php">											<!-- Link zur ersten Seite -->
              <i class="now-ui-icons design_app"></i>							<!-- Icon der ersten Seite -->
              <p>Dashboard</p>													<!-- Name des Links -->
            </a>
          </li>
          <li>
            <a href="./overview.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Meine Krankmeldungen</p>
            </a>
          </li>
          <li class="active">													<!-- Dies ist die aktuelle Seite, durch die class "active" wird dieses Element weiß unterlegt -->
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
            <a class="navbar-brand" href="">Krankmeldung erfassen</a>				<!-- Titel der Seite -->
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
                <a class="nav-link" href="./logout.php">							<!-- verlinktes Element oben rechts, um sich auszuloggen -->
                  <i class="now-ui-icons users_single-02"></i>
                  <p>logout
                    <span class="d-lg-none d-md-block"></span>
                  </p>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>																		<!-- Ende der Navbar -->

	  <div class="panel-header panel-header-sm">
        </div>
          <div class="content">	  													<!-- Beginn der div class "content" -->
		    <form method='POST' action='./submit2.php'>								<!-- Diese Seite beinhaltet ein Formular. Die Eingaben werden per POST an submit2.php übermittelt -->
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Krankmeldung erfassen</h4>					<!-- Titel der div class -->
				</div>									
			    <div class="card-body">
			  
<?php																																									//Der folgende Inhalt ist dynamsich, d.h. für jeden Anwender individuell. Es erfolgen Datenbankenoperationen
$wochentag=date("N");																																					//Abruf des Wochentages (N --> Montag=1, Dienstag=2 etc.)
$uhrzeit = date("H:i");																																					//Abruf der Uhrzeit (H:i --> z.B. 07:45)
$stundenbeginn = array("08:00", "08:45", "09:45", "10:30", "11:30", "12:15", "13:30", "14:15");																			//Initalisierung eines Arrays mit den Uhrzeiten des Stundenbeginns

																																										//Beginn der Datenbankabfrage (Anzahl der Schulstunden am heutigen Wochentag für den eingeloggten Schüler)
$statement = $pdo->prepare("SELECT COUNT(unterricht.stundennr) FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND unterricht.archived=0");
$result = $statement->execute();																																		//Abfrage wird ausgeführt
if ($statement->rowCount()==0)																																			//Wenn es keine Ergebnisse gibt
  {
    echo "Für heute sind im System keine Unterrichtsstunden für dich eingetragen. <br> Eine Krankmeldung kann nur direkt am jeweilligen Tag erfolgen.<br><br>";			//Wird per echo zurückgegeben, dass heute keine Unterrichtsstunden verfügbar sind (z.B. am Wochenende)
  }
	else
  {	
	$statement = $pdo->prepare("SELECT id, schueler_id, begruendung FROM `fehlstunden` WHERE schueler_id=$usernr AND datum=cast(now()as date)");						//Ansonsten wird abgefragt, ob der Schüler sich heute schon Krankgemeldet hat, um eine doppelte Abmeldung auszuschließen
	$result = $statement->execute();
	if($statement->rowCount()==0)																																		//Wenn das nicht der Fall ist...		
	  {
?> 
				  <div class="row">																																		<!-- Wird im folgenden eine Tabelle erzeugt mit den heutigen Schulstunden -->
				    <div class="col-md-6">
		              <table class='table'>
					    <thead>																																			<!-- Kopfzeile mit Überschriften -->
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
while($stundennr<9)																																						//Inerhalt der while-Schleife werden für jede Schulstunde die entsprechenden Unterrichtsfächer abgerufen
  {
    $statement = $pdo->prepare("SELECT unterricht.stundennr, unterricht.bezeichnung, users.nachname, unterricht.id FROM zuordnung_schueler_unterricht INNER JOIN unterricht ON zuordnung_schueler_unterricht.unterrichts_id=id INNER JOIN users ON unterricht.lehrer_id=users.id WHERE zuordnung_schueler_unterricht.schueler_id = $usernr AND unterricht.wochentag=$wochentag AND unterricht.stundennr=$stundennr AND unterricht.archived=0 ORDER BY unterricht.stundennr");
	$result = $statement->execute();								
	if($statement->rowCount()==0)																																		//Wenn der Schüler in einer Schulstunde kein Unterricht hat, werden Platzhalter in die Tabelle eingetragen
	  {
		echo "<tr>";
		echo "<td class='text-center'>".$stundennr."</td>";
		echo "<td>-----</td>";
		echo "<td>-----</td>";
		echo "<td></td>";
		echo "</tr>";
	  }
	else																																								//Ansonsten wird die Stundennr, die Unterrichtsbezeichnung und der Lehrername in die Tabelle eingetragen								
	  {
	    while($row = $statement->fetch()) 
		  {		
			echo "<tr>";
			echo "<td class='text-center'>".$stundennr."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";			
			if( $uhrzeit < $stundenbeginn[$stundennr-1])																												//Wenn die aktuelle Uhrzeit noch vor Stundenbeginn liegt,
     		  {																																							//Wird eine Checkbox aktiviert und ausgewählt (checked)
				echo "<td class='td-actions text-center'><div class='form-check form-check-inline'><label class='form-check-label'><input class='form-check-input' type='checkbox' checked name='fehlstunden[]' value='".$row[3]."'><span class='form-check-sign'></span></label></div></td>";
				echo "</tr>";
              }
			else 																																						//Ansonsten wird die Checkbox ausgeblendet (disabled), da eine Krankmeldung nach Stundenbeginn nicht mehr entschuldigt werden kann
	         {																																							//Bei den Checkboxen handelt es sich um ein Element des Forumlares. Jede Checkbox übergibt die Unterrichtsid (value=row[3]) an das Array fehlstunden (name=fehlstunden[])
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
						    <td class="text-center"><textarea type='text' class='form-control inputFileVisible' name ="fehltext" placeholder="Hier kannst du den Grund für dein Fehlen oder auch die voraussichtliche Dauer eintragen." row='5'></textarea></td>			<!-- In dieses Form-Element kann ein Text eingegeben werden -->
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
							<td><input id="inp_file" type="file"></td>																																																		<!-- Dieses Form-Element dient zum Hochalden eines Bildes -->
							<td><input id="inp_img" name="img" type="hidden" value=""></td>																																													<!-- Hierbei handelt es sich um ein verstecktes Feld, auf das für Javascript benötigt wird (siehe unten) -->
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
<?php																																																																		//Dieser php-Code erzeugt ein Informationskasten, mit unt. Inhalt der davon abhängt, ob der Schüler attestpflichtig ist.
$statement = $pdo->prepare("SELECT attestpflicht FROM users WHERE id=$usernr");																																																//Ausführung einer Datenbankabfrage
$result = $statement->execute();	
while($row = $statement->fetch()) 
  {		
	if($row[0]==0)																																																															//Text wenn keine Attestpflicht vorliegt
	  {
		echo"<div class='alert alert-info alert-with-icon' data-notify='container'>";	
		echo"<span data-notify='icon' class='now-ui-icons travel_info'></span>";	
		echo"<span data-notify='message'>Wenn dir noch kein Attest vorliegt, kannst du dieses auch nachträglich unter 'meine Krankmeldungen' hochladen.</span>";
		echo"</div>";
	  }
	else																																																																	//Text wenn Attestpflicht vorliegt														
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
					  <button class='btn btn-primary btn-block' type='reset'>Eingaben zurücksetzen</button><br>																																								<!-- Button zum Absenden des Formulares -->
					  <button class='btn btn-primary btn-block' type='submit'>Eingaben absenden</button>																																									<!-- Button zum Zurücksetzen des Formulares -->
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
		echo "Du hast heute schon eine Krankmeldung abgegeben.";																																																			//Fehlermeldung, wenn schon eine Krankmeldung vorliegen sollte
	  }
	}
?>
</div>  

<!--   -------------------------------------------------------------------------------------------------------------------------------JavaScript-------------------------------------------------------------------------------------------------------------------------------   -->
  
<script>
																																																																			//Basiert auf https://www.askingbox.de/tutorial/bild-vor-dem-upload-im-browser-verkleinern
function fileChange(e) { 																																																													//Script, um vor dem Upload die Bilder clientseitig zu verkleinern und so einen schnelleren Upload und Ressorcenschonung des Webservers zu ermöglichen									
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
 
  document.getElementById('inp_file').addEventListener('change', fileChange, false);    																																														//ruft das obere Script auf, sobald das oben erwähnte hidden-Element abgeschickt wird

</script>

        
<script>

if (<?php echo json_encode($state);?>==1)																																																										//Die folgenden Scripte rufen ein Sweetalert, d.h. ein Benachrichtugungs-Popup auf unt informieren, ob die Übermittlung der Krankmeldung erfolgreich war. 
	{																																																																			//Grundlage ist der Wert der variable state, der am Anfang der Datei abgefragt wird
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

   <!-- Hier werden weitere Scipte eingebunden, die im Bootstrap-Theme verwendet werden -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/now-ui-dashboard.min.js?v=1.3.0" type="text/javascript"></script>
  <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>

</body>

</html>