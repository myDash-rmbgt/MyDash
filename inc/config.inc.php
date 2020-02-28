<?php
/**
 * A complete login script with registration and members area.
 *
 * @author: Nils Reimers / http://www.php-einfach.de/experte/php-codebeispiele/loginscript/
 * @license: GNU GPLv3
 */
 
//Tragt hier eure Verbindungsdaten zur Datenbank ein
$db_host = 'localhost';
$db_name = 'xxxx';
$db_user = 'xxxx';
$db_password = 'xxxx';
$pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
