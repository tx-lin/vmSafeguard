<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Majestic Admin</title>
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
            	$VMs = 18 ; 
            	$allStarted = 10 ; 
            	$allSuspended = 2 ; 
            	$allPoweredOff = 6 ; 
            	echo "<input type=\"hidden\" id=\"esxiVMs\" name=\"esxiVMs\" value=\"$VMs\"/>";
            	echo "<input type=\"hidden\" id=\"esxiStartedVMs\" name=\"esxiStartedVMs\" value=\"$allStarted\"/>";
            	echo "<input type=\"hidden\" id=\"esxiSuspendedVMs\" name=\"esxiSuspendedVMs\" value=\"$allSuspended\"/>";
            	echo "<input type=\"hidden\" id=\"esxiPoweredOffVMs\" name=\"esxiPoweredOffVMs\" value=\"$allPoweredOff\"/>";
            	// echo $number;
            ?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">VMs graphe</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
          </div>
          <!-- 
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Area chart</h4>
                  <canvas id="areaChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Doughnut chart</h4>
                  <canvas id="doughnutChart"></canvas>
                </div>
              </div>
            </div>
          </div>
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
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Brlndtech Edit</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
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
