<?php


$ip = $_POST['ip'] ;
$port = $_POST['port'];

try {
	//open the database
	$db = new PDO('sqlite:' . __DIR__ . '/ewmt.db');
	// TRUNCATE Table 
	$db->exec("DELETE FROM esxi ;");
	$db->exec("INSERT INTO esxi (ip,port) VALUES ('$ip','$port');");
	$result = $db->query("SELECT ip FROM esxi ;");

	echo "You have added ESXI $ip port $port ";
}
catch(PDOException $e) {

print 'Exception : ' .$e->getMessage();

}
?>
<button type="button" class="btn btn-danger btn-rounded btn-fw"><a href="index.php">Back to the dashboard</a></button>