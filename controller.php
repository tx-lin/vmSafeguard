<?php

$HOST;
$PORT;

try {

	    $db = new PDO('sqlite:' . __DIR__ . '/ewmt.db');

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
}

catch(PDOException $e) {

	print 'Exception : ' .$e->getMessage();
}

$CHECKBACKUPFOLDER="ls -dt /vmfs/volumes/HDD2-backup/backup*"; // TO CHANGE !
$LOG="/vmfs/volumes/datastore1/logbackup.txt"; // TO CHANGE !
?>
