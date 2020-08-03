<?php
require '../controller.php';
?> 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Graph</title>
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
include('scripts-menu-header-top-left.php');
?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
            <?php 
              // backend 
              $countVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'vim-cmd vmsvc/getallvms | tail -n +2 | wc -l'");
              $poweredOnVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'esxcli vm process list | grep \"World ID\" | wc -l'");
              $shutdownVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < shutdownVMsList.sh");
              $statsPer100 = intval($poweredOnVMs) / intval($countVMs) * 100 ; 
            	echo "<input type=\"hidden\" id=\"esxiVMs\" name=\"esxiVMs\" value=\"$countVMs\"/>";
            	echo "<input type=\"hidden\" id=\"esxiStartedVMs\" name=\"esxiStartedVMs\" value=\"$poweredOnVMs\"/>";
            	echo "<input type=\"hidden\" id=\"esxiPoweredOffVMs\" name=\"esxiPoweredOffVMs\" value=\"$shutdownVMs\"/>";
              echo "<input type=\"hidden\" id=\"esxiStatsPer100\" name=\"stats\" value=\"$statsPer100\"/>";
            ?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">VMs graphe</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">% of ESXI occupation</h4>
                    <canvas id="doughnutChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--
          <div class="row">
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pie chart</h4>
                  <canvas id="pieChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Scatter chart</h4>
                  <canvas id="scatterChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <?php require 'scripts-footer.php'; ?>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/chart.js"></script>
  <!-- End custom js for this page-->
</body>

</html>
