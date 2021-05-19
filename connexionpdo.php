<?php 
try {

	$db = new PDO('sqlite:' . __DIR__ . '/scripts/vmSafeguard.db');
		
} catch(PDOException $e) {

	print 'Exception : ' .$e->getMessage();

}
?>