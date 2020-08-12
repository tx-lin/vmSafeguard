<?php
require '../controller.php';
include 'scripts-menu-header-top-left.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EWMT / ESXI Stats</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>
<?php 
// backend 
    $countVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'vim-cmd vmsvc/getallvms | tail -n +2 | wc -l'");
    $poweredOnVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'esxcli vm process list | grep \"World ID\" | wc -l'");
    $shutdownVMs = intval($countVMs) - intval($poweredOnVMs) ;  
    $osWindows = shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < detectOS.sh");
  	echo "<input type=\"hidden\" id=\"esxiVMs\" name=\"esxiVMs\" value=\"$countVMs\"/>";
   	echo "<input type=\"hidden\" id=\"esxiStartedVMs\" name=\"esxiStartedVMs\" value=\"$poweredOnVMs\"/>";
   	echo "<input type=\"hidden\" id=\"esxiPoweredOffVMs\" name=\"esxiPoweredOffVMs\" value=\"$shutdownVMs\"/>";
    echo "<input type=\"hidden\" id=\"vmOSWindows\" name=\"whichOs\" value=\"$osWindows\"/>";
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">VMs stats graphe</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">% OS kind  </h4>
                  <canvas id="doughnutChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        <?php require 'scripts-footer.php'; ?>
