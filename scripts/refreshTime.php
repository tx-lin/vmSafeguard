<!DOCTYPE html>
<html lang="en">
<?php require ('../connexionpdo.php')?>
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
                  <h4 class="card-title">vmSafeguard | REFRESH AUTOMATICALLY YOUR DASHBOARD EVERY X SECONDS </h4>
                  <p class="card-description">
                  <?php
                    if (!empty($_POST['refreshTime'])) {
                      
                        $refreshTime = htmlspecialchars($_POST['refreshTime']) ;
                        //open the database
                        $db = new PDO('sqlite:' . __DIR__ . '/vmSafeguard.db');
                        // TRUNCATE Table 
                        $db->exec("DELETE FROM webPanel ;");
                        $db->exec("INSERT INTO webPanel (RefreshTime) VALUES ('$refreshTime');");

                        $statement = $db->prepare("SELECT RefreshTime FROM webPanel ;"); // cette requête nous retourne un tableau à assiossatif ip=>
                        $rows = $statement->execute();
                        $rows = $statement->fetchAll();
                        
                        foreach ($rows as $row) {
                            $valueFromTheDB = htmlspecialchars($row['RefreshTime']);
                            echo "<pre>You dashboard will reload itself every $valueFromTheDB seconds</pre>";
                            echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
                            
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