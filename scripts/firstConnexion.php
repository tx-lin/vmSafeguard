<!DOCTYPE html>
<html lang="en">
<?php require ('../connexionpdo.php') ?>
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
<?php include('scripts-menu-header-top-left.php'); ?>
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
                
                  $HOST = $_POST['ip'] ;
                  $PORT = $_POST['port'];
                  $CHECKBACKUPFOLDER = $_POST['CheckBackupFolder'] ;
                  $ADMINEMAIL = $_POST["email"]; 
                  
                  
                  // TRUNCATE Table 
                  $db->exec("DELETE FROM esxi ;");
                  $db->exec("DELETE FROM esxiPath ;");
                  $db->exec("INSERT INTO esxi (ip,port) VALUES ('$HOST','$PORT');");
                  $db->exec("INSERT INTO esxiPath (CheckBackupFolder) VALUES ('$CHECKBACKUPFOLDER');");	
                    
                  $statement = $db->prepare("SELECT * FROM esxi ;"); 
                  $rows = $statement->execute();
                  $rows = $statement->fetchAll();
                  // print_r($result);
                      
                  foreach ($rows as $row) {
                      $HOST = $row['ip'];
                      $PORT = $row['port'];
                      echo "<pre>ESXI <strong>$HOST</strong> on ssh port <strong>$PORT</strong> has been added.<br>";
                  } 

                  $statement = $db->prepare("SELECT CheckBackupFolder FROM esxiPath ;"); 
                  $rows = $statement->execute();
                  $rows = $statement->fetchAll();

                  foreach ($rows as $row) {
                      $CHECKBACKUPFOLDER = $row['CheckBackupFolder'];
                      echo "index.php will check the latest backups with this absolute path <strong>$CHECKBACKUPFOLDER</strong> </pre><br>";
                  }

                  if  ((!empty($_POST["email"]))) {

                    $statement = $db->prepare("UPDATE users SET Email = '$ADMINEMAIL';"); 
                    $rows = $statement->execute();
                    $rows = $statement->fetchAll();
                       
                    $statement = $db->prepare("SELECT Email FROM users WHERE Username = 'admin' ;"); // SQLite n'est pas senssible à la casse depuis le terminal, mais depuis php si WTF !!!!! "40 minutes later..." 
                    $rows = $statement->execute();
                    $rows = $statement->fetchAll();
                    
                    foreach ($rows as $row) {
                      $ADMINEMAIL= $row['Email'];
                      echo "<pre>You have added the following admin email : <strong>$ADMINEMAIL</strong><br></pre>";

                    } 
                }
              echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>"; 
              shell_exec('sudo sh -c \'echo "$(date) - you have added a new ESXi to vmSafeguard IP :'.$HOST.' PORT : '.$PORT.' ! " >> /var/log/vmSafeguard-server.log\'');
              shell_exec('sudo sh -c \'echo "$(date) - you have added the following admin email :'.$ADMINEMAIL.' !" >> /var/log/vmSafeguard-server.log\'');
              shell_exec('sudo sh -c \'echo "$(date) - The dashboard will check '.$CHECKBACKUPFOLDER.'for the latest backup. " >> /var/log/vmSafeguard-server.log\'');
             
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