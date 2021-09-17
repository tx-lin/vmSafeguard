<?php 
require('../controller.php');
require('../connexionpdo.php');
$action = htmlspecialchars($_GET['action']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | <?php echo $action; ?></title>
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
<?php require('scripts-menu-header-top-left.php'); ?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">/ Action / <?php echo $action; ?> </h4>
                  <p class="card-description">
                      <?php

                            switch($action) {
                            
                                case "shutdownAll":    
                                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < shutdownAll.sh")."</pre>";
                                    break;
                                case "suspendAll":
                                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < suspendAll.sh")."</pre>";
                                    break;

                                case "startAll":
                                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < startAll.sh")."</pre>";
                                    break;
                                
                                case "summaryAll":
                                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < summaryAll.sh")."</pre>";
                                    break;
                                case "summarySingleVM":
                                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < summarySingleVM.sh ".$_POST['vmid']." &")."</pre>";
                                    break;
                                case "summarySingleVM":
                                    if (!empty(htmlspecialchars($_POST['vmid']))) {
                                        echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < summarySingleVM.sh ".$_POST['vmid']." &")."</pre>";
                                    }
                                    else {
                                        echo "<pre> The vmid can not be nul ! </pre>";
                                    }
                                    break;
                                case "timeRefreshPercent":
                                    shell_exec("sed -i 's/timeRefreshPercentBackup=.*/timeRefreshPercentBackup=\"sleep ".$_POST['timeRefreshPercent']."\"/' backup.sh");
                                    echo "<pre>".shell_exec("sudo cat backup.sh")."</pre>";
                                    break;
                                case "ChangeBackupDatastore":
                                    shell_exec("sed -i 's/DATASTORE=.*/DATASTORE=\"".$_POST['ChangeBackupDatastore']."\"/' backup.sh");
                                    echo "<pre>".shell_exec("sudo cat backup.sh")."</pre>";
                                    break;
                                case "valueInDays": 
                                    shell_exec('sed -i \'/-mtime/cfind /vmfs/volumes/$DATASTORE/backup* -mtime +'.$_POST['valueInDays'].' -exec rm -rf {} \\\; \' backup.sh');
                                    echo "<pre>".shell_exec("sudo cat backup.sh")."</pre>";
                                    break;
                                case "refreshTime": 
                                    require("refreshTime.php");
                                    break; 
                                case "editCoreValue":
                                    require("firstConnexion.php");
                                    break;
                                case "updateCredentials": 
                                    require("updateCredentials.php");
                                    break; 
                                case "crontask": 
                                    require("crontask.php");
                                    break; 
                                case "": 
                                    require("updateCredentials.php");
                                    break; 
                                case "saveCronTask": 
                                    require("saveCronTask.php");
                                    break; 
                                case "showLogs":
                                    echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"#footer\" >Latest logs</a></button>";
                                    echo "<pre>".shell_exec("sudo sh -c 'cat /var/log/vmSafeguard-server.log | tail -1000'")."</pre>";
                                    echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"#head\" >Oldest logs</a></button>";
                                    break;
                                case "stats": 
                                    require("esxiStats.php"); 
                                    break;
                                case "backup": 
                                    require("backup.php"); 
                                    break;
                                default: 
                                    echo "<pre>Wrong value action</pre>";
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
<?php require('scripts-footer.php') ?>
