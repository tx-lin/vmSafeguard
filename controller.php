<?php

$HOST;
$PORT;
$CHECKBACKUPFOLDER;
$LOG;

try {

	$db = new PDO('sqlite:' . __DIR__ . '/scripts/vmSafeguard.db');

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
		
}

catch(PDOException $e) {

	print 'Exception : ' .$e->getMessage();

}
?>
