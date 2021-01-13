<?php

require 'connexionpdo.php';

$HOST;
$PORT;
$CHECKBACKUPFOLDER;
$LOG;
$REFRESHTIME;

	$statement = $db->prepare("SELECT * FROM esxi ;"); // cette requête nous retourne un tableau à assiossatif ip=>
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
		
	foreach ($rows as $row) {
		$HOST = $row['ip'];
		$PORT = $row['port'];
	
	} 

	$statement = $db->prepare("SELECT * FROM esxiPath ;"); // cette requête nous retourne un tableau à assiossatif ip=>
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
		$CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
		$LOG = $row['LogsPath'];
		
	}
	
	$statement = $db->prepare("SELECT RefreshTime FROM webPanel ;"); // cette requête nous retourne un tableau à assiossatif ip=>
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
		$REFRESHTIME = $row['RefreshTime'];	
		// echo $REFRESHTIME;	
	} 
		

?>
