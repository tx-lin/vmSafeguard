<?php

$HOST;
$PORT;
$CHECKBACKUPFOLDER;
$LOG;

try {

	    $db = new PDO('sqlite:' . __DIR__ . '/scripts/ewmt.db');

		$statement = $db->prepare("SELECT * FROM esxi ;"); // cette requête nous retourne un tableau à assiossatif ip=>
		$rows = $statement->execute();
		$rows = $statement->fetchAll();
		// print_r($result);
		
		foreach ($rows as $row) {
			$HOST = $row['ip'];
			$PORT = $row['port'];
			// echo $HOST;
			// echo $PORT;
		
	    } 

	    $statement = $db->prepare("SELECT * FROM esxiPath ;"); // cette requête nous retourne un tableau à assiossatif ip=>
		$rows = $statement->execute();
		$rows = $statement->fetchAll();
		// print_r($result);
		foreach ($rows as $row) {
			$CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
			$LOG = $row['LogsPath'];
			// echo $HOST;
			// echo $PORT;
		
		} 
		
}

catch(PDOException $e) {

	print 'Exception : ' .$e->getMessage();
}
echo "<br>".__DIR__."";
?>
