<?php 
require('../controller.php');
?>
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
                  <h4 class="card-title">vmSafeguard | Connect to an other ESXi</h4>
                  <p class="card-description">
                  <?php
                    // if (isset($_POST['ip']) && isset($_POST['port'])) {
                    if (isset($_POST['submit'])) {
                      
                      $ip = $_POST['ip'] ;
                      $port = $_POST['port'];
          
                      try {
                        //open the database
                        $db = new PDO('sqlite:' . __DIR__ . '/vmSafeguard.db');
                        // TRUNCATE Table 
                        $db->exec("DELETE FROM esxi ;");
                        $db->exec("INSERT INTO esxi (ip,port) VALUES ('$ip','$port');");
                        $result = $db->query("SELECT ip FROM esxi ;");
          
                        echo "<pre>You have added ESXI $ip port $port </pre>";
                        echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
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