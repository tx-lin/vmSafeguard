<?php

require 'connexionpdo.php';

$HOST;
$PORT;
$CHECKBACKUPFOLDER;
$LOG;
$REFRESHTIME;
$ADMINEMAIL;
$VMSAFEGUARD_IP;

	$statement = $db->prepare("SELECT * FROM esxi ;"); // select ip and port for the current esxi 
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
		
	foreach ($rows as $row) {
		$HOST = $row['ip'];
		$PORT = $row['port'];
	
	} 

	$statement = $db->prepare("SELECT CheckBackupFolder FROM esxiPath ;"); // select the common datastore of ESXi(s) 
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
		$CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
		// $LOG = $row['LogsPath']; Since 18/08/2021, vmSafeguard store logs into the vmSafeguard server instance.
		
	}
	
	$statement = $db->prepare("SELECT RefreshTime FROM webPanel ;"); // selecting the time for auto refresh (dashboard : index.php)
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
		$REFRESHTIME = $row['RefreshTime'];	
	} 
	
	$statement = $db->prepare("SELECT Email FROM users WHERE Username = 'admin' ;"); // selecting the email for mailing after the backup process 
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
	  $ADMINEMAIL= $row['Email'];
	} 

	$statement = $db->prepare("SELECT Ip,Port FROM vmSafeguardHost WHERE Id = '1' ;"); // selecting the email for mailing after the backup process 
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
	
	foreach ($rows as $row) {
		$VMSAFEGUARD_IP = $row['Ip'];
	} 

?>
