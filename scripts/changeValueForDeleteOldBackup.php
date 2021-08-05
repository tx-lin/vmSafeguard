<!DOCTYPE html>
<html lang="en">
<?php require ('../controller.php')?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> vmSafeguard | Auto delete old backup </title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
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
                  <h4 class="card-title">vmSafeguard | Auto delete old backup</h4>
                  <p class="card-description">
                  <?php
                    if (isset($_POST['valueInDays'])) {
                        shell_exec('sed -i \'/-mtime/cfind /vmfs/volumes/$DATASTORE/backup* -mtime +'.$_POST['valueInDays'].' -exec rm -rf {} \\\; \' backup.sh');
                        echo "<pre>".shell_exec("sudo cat backup.sh")."</pre>";
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