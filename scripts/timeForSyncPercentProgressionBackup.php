<?php require('../controller.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Cron Schedulled</title>
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
<?php include('scripts-menu-header-top-left.php');?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Refresh Percent Time </h4>
                  <p class="card-description">
                    the file bash.sh will be updated. 
                    <?php
                      if (isset($_POST['timeRefreshPercent'])) {
                        shell_exec("sed -i 's/timeRefreshPercentBackup=.*/timeRefreshPercentBackup=\"sleep ".$_POST['timeRefreshPercent']."\"/' backup.sh");
                        echo "<pre>".shell_exec("sudo cat backup.sh")."</pre>";
                      }
                      else {
                        echo "Wrong value.";
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
