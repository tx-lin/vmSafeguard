<?php 
require('../controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EWMT | Cron Schedulled</title>
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
                  <h4 class="card-title">Cron Schedulled</h4>
                  <p class="card-description">
                    Verify that your task has been corretly written ! Otherwise, check again the crontask syntax.
                    <?php
                    shell_exec("sudo echo \"".htmlspecialchars($_POST['min'])." ".htmlspecialchars($_POST['hour'])." ".htmlspecialchars($_POST['dayOfMonth'])." ".htmlspecialchars($_POST['month'])." ".htmlspecialchars($_POST['dayOfWeek'])." sudo ssh -p $PORT root@$HOST 'sh -s' < /var/www/html/ESXi-Web-Management-Tool/scripts/PoolVMBackup.sh &\" | crontab -")."</pre>";

                    // echo $_POST['min']." ".$_POST['hour']." ".$_POST['dayOfMonth']." ".$_POST['month']." ".$_POST['dayOfWeek']." sudo ssh -p $PORT root@$HOST 'sh -s' < /var/www/html/ESXi-Web-Management-Tool/scripts/\" | crontab -";

                    echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
                    // cron task will be stored in /var/spool/cron/crontabs/www-data 
                    // 
                  ?>
                  </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include('scripts-footer.php') ?>
