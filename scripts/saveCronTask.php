<?php 
require('../controller.php');
$crontaskID = random_int (100,1000 ) ;
$scriptPath = "/var/www/html/vmSafeguard/scripts/backup.sh" ; 
?>
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
                      if (isset($_POST['Pool'])) {
                        shell_exec("sudo echo -e \"$(crontab -u www-data -l)\n".$_POST['min']." ".$_POST['hour']." ".$_POST['dayOfMonth']." ".$_POST['month']." ".$_POST['dayOfWeek']." sudo ssh -p $PORT root@$HOST 'sh -s' < ".$scriptPath." ".$_POST['vmid']." & # ".$crontaskID."\" | crontab -u www-data -")."</pre>";
                        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
                        // cron task will be stored in /var/spool/cron/crontabs/www-data
                      }
                      else if (isset($_POST['Single'])) {
                        shell_exec("sudo echo -e \"$(crontab -u www-data -l)\n".$_POST['min']." ".$_POST['hour']." ".$_POST['dayOfMonth']." ".$_POST['month']." ".$_POST['dayOfWeek']." sudo ssh -p $PORT root@$HOST 'sh -s' < ".$scriptPath." ".$_POST['vmid']." & # ".$crontaskID."\" | crontab -u www-data -")."</pre>";
                        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
                        // cron task will be stored in /var/spool/cron/crontabs/www-data
                      }
                      else if (isset($_POST['crontaskID'])) {
                        if ($_POST['crontaskID'] == "000") {
                          shell_exec("sudo rm /var/spool/cron/crontabs/www-data");
                        }
                        shell_exec("sudo sed -i '/".$_POST['crontaskID']."/d' /var/spool/cron/crontabs/www-data");
                        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
                      }
                      else {
                        echo "Wrong Crontask, try again.";
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
