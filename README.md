<p>&nbsp;P R O J E K T D O K U M E N T A T I O N</p>
<p>im Unterrichtsfach angewandte Wirtschaftsinformatik</p>
<p>&nbsp;<br /> <strong>Entwicklung einer Webanwendung zur Fehlstundenverwaltung in der gymnasialen Oberstufe</strong></p>
<p>&nbsp;</p>
<ol>
<li>Einf&uuml;hrung und Zielsetzung</li>
</ol>
<p>Gegenstand des Projektes ist, das heute im Wirtschaftsgymnasium eingesetzte analoge System zur Verwaltung und Dokumentation von Fehlstunden und Krankmeldungen, durch eine digitale Webanwendung zu ersetzen, die eine Kommunikation zwischen Sch&uuml;lern sowie Klassen- und Kurslehrern erm&ouml;glicht.</p>
<p>Das derzeitige System, das prim&auml;r auf Entschuldigungskarten, die durch die Sch&uuml;ler gef&uuml;hrt werden, basiert, wird von beiden Seiten als sehr umst&auml;ndlich bewertet:</p>
<ul>
<li>Hoher b&uuml;rokratischer Aufwand &agrave; Verlust von Unterrichtszeit</li>
<li>Entschuldigungskarten k&ouml;nnen verloren gehen</li>
<li>Klassenlehrer haben keine aktuelle &Uuml;bersicht &uuml;ber die Fehlzeiten ihrer Sch&uuml;ler (intransparent)</li>
</ul>
<p>Das neue System soll genau an diesen Problemquellen ansetzten und eine zeitgem&auml;&szlig;e L&ouml;sung erm&ouml;glichen. Bei der Umsetzung wurde besonderer Wert auf die folgenden Punkte gelegt:</p>
<ul>
<li>Nutzerfreundlichkeit &agrave; begrenzter und m&ouml;glichst selbsterkl&auml;render Funktionsumfang</li>
<li>Responsive Design &agrave; optimierte Darstellung auf allen Endger&auml;ten</li>
<li>Autonom &agrave; geringer Administrationsaufwand, da selbstst&auml;ndige Verwaltung durch Klassenlehrer</li>
</ul>
<p>Jeder Benutzer hat ein eigenes Profil, auf das er mittels seiner Emailadresse und einem Passwort zugreifen kann.</p>
<p>&nbsp;</p>
<ol start="2">
<li>Architektur der Webanwendung</li>
</ol>
<p>&nbsp;</p>
<ol start="3">
<li>Entity Relationship Diagramm der Datenbank</li>
</ol>
<p>Im Gegensatz zu Webseiten, wie der offiziellen Schulhomepage, die gro&szlig;enteils statische Elemente beinhaltet, werden bei dieser Webanwendung viele Inhalte dynamisch erzeugt, da sich diese bei jedem Benutzer unterscheiden. Wie schon skizziert, bildet hierf&uuml;r eine Datenbank die Grundlage.</p>
<p>&nbsp;</p>
<ol start="4">
<li>Funktionsumfang</li>
</ol>
<p>Generell ist zwischen zwei Anwenderprofilen zu differenzieren &ndash; Sch&uuml;ler und Lehrer &ndash; die jeweils die Berechtigung haben, auf unterschiedliche Unterseiten und Funktionen zuzugreifen. Seiten, die das Login betreffen, sind jeweils identisch und leiten zum entsprechenden Profil weiter.</p>
<table width="605">
<tbody>
<tr>
<td width="54">
<p><strong>Login</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; login.php</p>
</td>
<td width="400">
<p>Emailadresse und Passwort werden &uuml;berpr&uuml;ft</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; logout.php</p>
</td>
<td width="400">
<p>Der Benutzer wird abgemeldet, Session-Cookies gel&ouml;scht</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; register.php</p>
</td>
<td width="400">
<p>Der Sch&uuml;ler kann sich mittels Einmalkey- und Pass registrieren</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; passwortvergessen.php</p>
</td>
<td width="400">
<p>Der Benutzer kann sein Passwort per Email zur&uuml;cksetzen</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>Sch&uuml;ler</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; dashboard.php</p>
</td>
<td width="400">
<p>Landingpage, mit einigen Daten u.a. aktueller Stundenplan</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; overview.php</p>
</td>
<td width="400">
<p>&Uuml;bersicht &uuml;ber alle Krankmeldungen des Sch&uuml;lers</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; submit.php</p>
</td>
<td width="400">
<p>Formular zum Absenden einer neuen Krankmeldung</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; submit2.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus submit.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; submit3.php</p>
</td>
<td width="400">
<p>Nachtr&auml;gliches Hochladen eines Attests</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; submit4.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus submit3.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; mitteilungen.php</p>
</td>
<td width="400">
<p>z.zt. noch nicht</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; settings.php</p>
</td>
<td width="400">
<p>Einstellen und &Auml;ndern von Userdaten (z.B. Emailadresse, Passwort)</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; update.php</p>
</td>
<td width="400">
<p>Auswahl des individuellen Stundenplans (wird automatisch aufgerufen)</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; update2.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus update.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>Lehrer</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; lhr/dashboard.php</p>
</td>
<td width="400">
<p>Landingpage, mit einigen Daten u.a. Unterrichtsplan</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; lhr/classes.php</p>
</td>
<td width="400">
<p>Auswahl einer eigenen Klasse und Klassenliste</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; classes2.php</p>
</td>
<td width="400">
<p>Fehlstunden eines Sch&uuml;lers zur&uuml;cksetzen</p>
</td>
</tr>
<tr>
<td width="54">
<p><strong>&nbsp;</strong></p>
</td>
<td width="151">
<p>o&nbsp; classes3.php</p>
</td>
<td width="400">
<p>Sch&uuml;ler l&ouml;schen (Sch&uuml;ler verl&auml;sst Klasse)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes4.php</p>
</td>
<td width="400">
<p>Klassennamen &auml;ndern (Neues Schuljahr)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes5.php</p>
</td>
<td width="400">
<p>Neuen Stundenplan hinterlegen (Neues Schuljahr/&Auml;nderungen)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes6.php</p>
</td>
<td width="400">
<p>Neue Sch&uuml;ler der Klasse hinzuf&uuml;gen (Einmalkey- und Pass generieren)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes7.php</p>
</td>
<td width="400">
<p>Fehlstunden der Klasse zur&uuml;cksetzen (Neues Halbjahr)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes8.php</p>
</td>
<td width="400">
<p>Klasse l&ouml;schen (Klasse verl&auml;sst Schule)</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes9.php</p>
</td>
<td width="400">
<p>Neue Klasse anlegen und Einmalkey- und Pass generieren</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes10.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus classes5.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes11.php</p>
</td>
<td width="400">
<p>Attestpflicht f&uuml;r einen Sch&uuml;ler hinterlegen</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; classes12.php</p>
</td>
<td width="400">
<p>Attestpflicht f&uuml;r einen Sch&uuml;ler l&ouml;schen</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; lhr/courses.php</p>
</td>
<td width="400">
<p>Auswahl eines Kurses und Kursliste</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; courses2.php</p>
</td>
<td width="400">
<p>Anwesenheit eines Kurses erfassen</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; courses3.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus courses2.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; lhr/mitteilungen.php</p>
</td>
<td width="400">
<p>Anzeigen ausstehender Krankmeldungen, die bearbeitet werden m&uuml;ssen</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>o&nbsp; lhr/mitteilungen2.php</p>
</td>
<td width="400">
<p>&Uuml;bermittelte Daten aus mitteilungen.php werden verarbeitet</p>
</td>
</tr>
<tr>
<td width="54">
<p>&nbsp;</p>
</td>
<td width="151">
<p>&middot;&nbsp;&nbsp;&nbsp; lhr/settings.php</p>
</td>
<td width="400">
<p>Einstellen und &Auml;ndern von Userdaten (z.B. Emailadresse, Passwort)</p>
</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<p>* Blau unterlegte Seiten sind nicht sichtbar, sondern f&uuml;hren Aktionen im Hintergrund aus, nachdem diese aufgerufen werden.</p>
<p>&nbsp;</p>
<ol start="5">
<li>Bausteine der Webanwendung</li>
</ol>
<p>&nbsp;</p>
<ul>
<li>Bootstrap-Theme: Bootstrap ist ein Fronted-Framework, mit dem unterschiedlichste Website-Elemente responsive dargestellt werden k&ouml;nnen. Diese Webanwendung basiert auf einem kostenfreien, als open-source-Version zur Verf&uuml;gung gestellten Theme. Es enth&auml;lt HTML-, CSS- und JAVASCRIPT-Elemente.<a href="#_ftn1" name="_ftnref1">[1]</a></li>
<li>Login-Script: Das Login-Script basiert ebenfalls auf einem als open-source zur Verf&uuml;gung gestellten Programmcode. Hierbei ist u.a. implementiert, dass Passw&ouml;rter per HASH verschl&uuml;sselt und somit in der Datenbank nicht im Klartext abgespeichert werden.<a href="#_ftn2" name="_ftnref2">[2]</a></li>
<li>PHP: Die Programmiersprache wird zur Kommunikation mit der Datenbank eingesetzt (&bdquo;Data Objects&ldquo;) und dient somit vorwiegend zur Generierung von dynamischen Inhalten.</li>
<li>SWEETALERT2: Eine Bibliothek f&uuml;r JavaScript zur Erzeugung von Benachrichtigungsfelder&nbsp;(z.B. zum Anzeigen von Attesten)</li>
</ul>
<p>&nbsp;</p>
<ol start="6">
<li>Codebeispiel</li>
</ol>
<p>Jedes einzelne Programmscript genau zu erkl&auml;ren, w&uuml;rde an dieser Stelle den Rahmen sprengen, daher ist auf github.com stellvertretend eine kommentierte Dokumentation von submit.php, dem Programmteil, mittels dessen sich Sch&uuml;ler krankmelden k&ouml;nnen, zu finden.</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p><a href="#_ftnref1" name="_ftn1">[1]</a> <a href="https://www.creative-tim.com/product/now-ui-dashboard">https://www.creative-tim.com/product/now-ui-dashboard</a></p>
<p><a href="#_ftnref2" name="_ftn2">[2]</a> <a href="https://github.com/PHP-Einfach/loginscript">https://github.com/PHP-Einfach/loginscript</a></p>
