<!DOCTYPE html>
<html lang="en">
<?php require ('../controller.php')?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> vmSafeguard | Change disk format  </title>
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
                  <h4 class="card-title">vmSafeguard | Change disk format</h4>
                  <p class="card-description">
                  <?php
                    if (isset($_POST['changeDiskFormat'])) {
                        echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < checkIfVMExist.sh ".$_POST['vmid']."")."</pre>";
                        shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < changeDiskFormat.sh ".$_POST['vmid']." ".$_POST['changeDiskFormat']." > /dev/null 2>/dev/null & ")."";
                        echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"changeDiskFormatStatus.php\" >Latest logs</a></button>";
                    }
                    else {
                      echo "no argument";
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