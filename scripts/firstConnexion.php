<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Connect to an other ESXi </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
<?php
include('scripts-menu-header-top-left.php');
?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">vmSafeguard | First Connexion</h4>
                  <p class="card-description">
					<?php
						if (isset($_POST['submit'])) {
							
							$ip = $_POST['ip'] ;
							$port = $_POST['port'];
							$checkBackupFolder = $_POST['CheckBackupFolder'] ;
							$logsPath = $_POST['LogsPath'];

							try {
								//open the database
								$db = new PDO('sqlite:' . __DIR__ . '/vmSafeguard.db');
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

									echo "<pre>You have added ESXI <strong>$ip</strong> on ssh port <strong>$port</strong> <br>";
								} 

								$statement = $db->prepare("SELECT * FROM esxiPath ;"); // cette requête nous retourne un tableau à assiossatif ip=>
								$rows = $statement->execute();
								$rows = $statement->fetchAll();

								foreach ($rows as $row) {

									$CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
									$LOG = $row['LogsPath'];
									echo "index.php will check the latest backup with this absolute path <strong>$CHECKBACKUPFOLDER</strong> <br>";
									echo "scripts/show-log.php will check the latest backup logs with this absolute path to the file <strong>$LOG</strong> <br> </pre>";
									echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
								} 
							}
							catch(PDOException $e) {

								print 'Exception : ' .$e->getMessage();

							}
						}
					?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include('scripts-footer.php') ?>