<?php 
require('../controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EWMT | Backup Single VM</title>
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
                  <h4 class="card-title">Summary of <?php echo $_POST['vmid'];?> </h4>
                  <p class="card-description">
                  <?php
      						if (isset($_POST['vmid'])) {
                    echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < summarySingleVM.sh ".$_POST['vmid']." &")."</pre>";
      						}
      						else {
      							echo "WARNING = The VMID that you have entered is not attached to any VM. ";
      						}
      						?>
                  </p>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('scripts-footer.php') ?>
