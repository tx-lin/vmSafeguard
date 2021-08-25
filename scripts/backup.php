<?php require('../controller.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Backup Single VM</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../other/favicon-32x32.png" />
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
                  <h4 class="card-title">Backup Single VM</h4>
                  <p class="card-description">
                    <?php
                    if (isset($_POST['vmid'])) {
                        echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < checkIfVMExist.sh ".$_POST['vmid']."")."";
                        shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < backup.sh ".$VMSAFEGUARD_IP." ".$_POST['vmid']." > /dev/null 2>/dev/null &");
                        sleep (1);
                        $CHECKBACKUPFOLDER="".$CHECKBACKUPFOLDER."backup*";
                        echo "New root backup folder has been created to welcome VM(s) backup : ".shell_exec("sudo ssh -p $PORT root@$HOST 'ls -dt1 $CHECKBACKUPFOLDER | head -n 1 '")."</pre>";
                        echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"show-log.php#footer\" >Latest logs</a></button>";
                    }
                    else {
                      echo "<pre> WARNING = One or more VMIDs that you have entered is not attached to any VM. </pre>";
                    }
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