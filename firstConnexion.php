<?php


$ip = $_POST['ip'] ;
$port = $_POST['port'];
$checkBackupFolder = $_POST['CheckBackupFolder'] ;
$logsPath = $_POST['LogsPath'];

try {
	//open the database
	$db = new PDO('sqlite:' . __DIR__ . '/ewmt.db');
	// TRUNCATE Table 
	$db->exec("DELETE FROM esxi ;");
	$db->exec("DELETE FROM esxiPath ;");
	$db->exec("INSERT INTO esxi (ip,port) VALUES ('$ip','$port');");
	$db->exec("INSERT INTO esxiPath (CheckBackupFolder,LogsPath) VALUES ('$checkBackupFolder','$logsPath');");	
	
	$statement = $db->prepare("SELECT * FROM esxi ;"); // cette requête nous retourne un tableau à assiossatif ip=>
	$rows = $statement->execute();
	$rows = $statement->fetchAll();
		// print_r($result);
		
	foreach ($rows as $row) {
		$HOST = $row['ip'];
		$PORT = $row['port'];

		echo "You have added ESXI $ip port $port <br> ";
	} 

	$statement = $db->prepare("SELECT * FROM esxiPath ;"); // cette requête nous retourne un tableau à assiossatif ip=>
	$rows = $statement->execute();
	$rows = $statement->fetchAll();

	foreach ($rows as $row) {

		$CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
		$LOG = $row['LogsPath'];
		echo "index.php will check the latest backup with this absolute path $checkBackupFolder <br> ";
		echo "scripts/show-log.php will check the latest backup with this absolute path $checkBackupFolder <br> ";
	} 
}
catch(PDOException $e) {

	print 'Exception : ' .$e->getMessage();

}
?>
<button type="button" class="btn btn-danger btn-rounded btn-fw"><a href="index.php">Back to the dashboard</a></button>