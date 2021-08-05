<?php 
require('controller.php');
$starttime = microtime(true); // Top of page
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="<?php echo $REFRESHTIME;?>">
  <title>vmSafeguard</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="other/favicon-32x32.png" />
  <?php

    exec("ping -c 1 " . $HOST, $output, $result);

    if ($result == 1) {

        echo "<script>alert('Your ESXi ".$HOST." appears to be offline ')</script>";
        shell_exec('sudo sh -c \'echo "$(date) - WARNING vmSafeguard has detected that your ESXi '.$HOST.' appears to be offline" >> /var/log/vmSafeguard-server.log\'');
    
    } else {
      
      shell_exec('sudo sh -c \'echo "$(date) - your ESXi '.$HOST.' is reachable" >> /var/log/vmSafeguard-server.log\'');     
    }

    $checkDatastoresSpaceLeft=shell_exec('sudo ssh -p '.$PORT.' root@'.$HOST.' \'sh -s\' < scripts/checkDatastoreSpaceLeft.sh');

    if (!empty($checkDatastoresSpaceLeft)) {

      echo "<script>alert('".preg_replace('/[^\p{L}[:print:]]/u', ' ', $checkDatastoresSpaceLeft)."')</script>";
      shell_exec('sudo sh -c \'echo "$(date) - WARNING vmSafeguard has detected that '.preg_replace('/[^\p{L}[:print:]]/u', ' ', $checkDatastoresSpaceLeft).'" >> /var/log/vmSafeguard-server.log\'');
      // this regex allow all special chars, number and Aa, trought a non-php string (come from a output of the following shell script : checkDatastoreSpaceLeft.sh)
    
    } else {

      shell_exec('sudo sh -c \'echo "$(date) - Storage capacity left of your datastores appears to be convenable" >> /var/log/vmSafeguard-server.log\'');     
    }
  ?>
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex justify-content-center">
        <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
          <img src="other/logo-vmSafeguard.png" style="height: 40px; width: 40px;" alt="logo"/>
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
          </button>
        </div>  
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-4 w-100">
          <li class="nav-item nav-search d-none d-lg-block w-100">
            <div class="input-group">
              <div class="input-group-prepend">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="other/admin.png" alt="profile"/>
              <span class="nav-profile-name">Admin</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="scripts/settings.php">
                <i class="mdi mdi-settings text-primary"></i>
                Settings
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="mdi mdi-home menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="scripts/crontask.php">
              <i class="mdi mdi-calendar-clock menu-icon"></i>
              <span class="menu-title">Schedule a backup</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="scripts/show-log.php">
              <i class="mdi mdi-note-text menu-icon"></i>
              <span class="menu-title">Logs</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://github.com/archidote/vmSafeguard/blob/master/README.md" target="_blank">
              <i class="mdi mdi-file-document-box-outline menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                  <div class="mr-md-3 mr-xl-5">
                    <h2>Welcome back,</h2>
                    <p class="mb-md-0">You are connected to : <?php echo shell_exec("sudo ssh -p $PORT root@$HOST 'hostname'");?>
                    <?php echo shell_exec("sudo ssh -p $PORT root@$HOST 'esxcli system version get | grep Version'");?></p>
                    <p class="mb-md-0">
                      <?php echo shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < scripts/getIPNM.sh");?> 
                    </p>
                  </div>
                  <div class="d-flex">
                    <i class="mdi mdi-home text-muted hover-cursor"></i>
                    <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                  <button class="btn btn-primary mt-2 mt-xl-0"><a style="color:white;"href="scripts/esxiStats.php" >ESXI Stats</a></button>
                </div>
              </div>
            </div>
          </div>
          <div class="row" id="proBanner">
            <div class="col-md-12 grid-margin">
              <div class="card bg-gradient-primary border-0">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body dashboard-tabs p-0">
                  <ul class="nav nav-tabs px-4" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">VM's Summary</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="" data-toggle="tab" href="#switch-to-an-other-esxi" role="tab" aria-controls="sales" aria-selected="false">Switch to a other ESXi</a>
                    </li>
                  </ul>
                  <div class="tab-content py-0 px-0">
                    <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-counter mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Number of VMs</small>
                            <h5 class="mr-2 mb-0"><?php $countVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'vim-cmd vmsvc/getallvms | tail -n +2 | wc -l'"); echo $countVMs ; ?></h5> 
                          </div>
                        </div>
                        <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-arrow-right-drop-circle-outline mr-3 icon-lg text-success"></i> <!-- icon -->
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Powered VMs </small>
                            <h5 class="mr-2 mb-0"><?php $poweredOnVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'esxcli vm process list | grep \"World ID\" | wc -l'"); echo $poweredOnVMs ; ?></h5> 
                          </div>
                        </div>
                        <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <i class="mdi mdi-flag mr-3 icon-lg text-danger"></i>
                          <div class="d-flex flex-column justify-content-around">
                            <small class="mb-1 text-muted">Shutdown VMs</small>
                            <?php //backend 
                              $shutdownVMs = intval($countVMs) - intval($poweredOnVMs) ; 
                            ?>
                            <h5 class="mr-2 mb-0"><?php echo $shutdownVMs ; ?></h5> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="sales" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <form class="form-inline" target="_blank" action="scripts/summarySingleVM.php" method="post">                  
                            <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
                            <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"></div>
                              </div>
                              <input type="text" class="form-control" required name="vmid" id="inlineFormInputGroupUsername2" placeholder="Enter a VM name">
                            </div>
                            <div class="form-check mx-sm-2">
                            </div>
                            <button type="submit" class="btn btn-warning mb-2"><a style="color:white">Get info</a></button>
                          </form>                       
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="switch-to-an-other-esxi" role="tabpanel" aria-labelledby="sales-tab">
                      <div class="d-flex flex-wrap justify-content-xl-between">
                        <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                          <form class="form-inline" target="_blank" action="scripts/connectToAOtherESXi.php" method="post">                  
                            <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
                            <div class="input-group mb-2 mr-sm-2">
                              <div class="input-group-prepend">
                                <div class="input-group-text"></div>
                              </div>
                              <input type="text" class="form-control" required name="ip" id="inlineFormInputGroupUsername2" placeholder="ESXi IP (ex:10.0.0.1)">
                              <input type="text" class="form-control" required name="port" id="inlineFormInputGroupUsername2" placeholder="ESXi SSH Port (ex: 22)">
                            </div>
                            <div class="form-check mx-sm-2">
                            </div>
                            <button type="submit" name="submit" class="btn btn-warning mb-2"><a style="color:white">Connect</a></button>
                          </form>                       
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Last Backup(s) : </p>
                  <i><p class="mb-4">Content of your "Backup datastore" : <?php echo $CHECKBACKUPFOLDER ?></p></i>
                  <h5 class="mr-2 mb-0">
                    <?php
                      $CHECKBACKUPFOLDER = "$CHECKBACKUPFOLDER/backup*";
                      echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'find $CHECKBACKUPFOLDER -type d -print | sed -e \"s;[^/]*/;|--;g;s;--|; |;g\"'")."</pre>";
                      //echo "<pre style=\"width: 800px; height:200px;\">".shell_exec("sudo ssh -p $PORT root@$HOST 'find $CHECKBACKUPFOLDER -type d -print | sed -e \"s;[^/]*/;|--;g;s;--|; |;g\"'")."</pre>";
                    ?>
                  </h5>
                </div>
              </div>
            </div>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
	                <!--<p class="card-title">Total sales</p>-->
	                <!--<h1>$ 28</h1>-->
	                <p class="card-title">Quick actions : </p>
	                <p class="text-muted"></p>
	                <div id="total-sales-chart-legend"></div>                  
	                	<button type="button" class="btn btn-success btn-rounded btn-fw" style="width:165px;height:40px;margin:0 auto;display:block;"><a style="color:white;"href="scripts/startAll.php">Start all VM</a></button> <br>
                    <button type="button" class="btn btn-danger btn-rounded btn-fw" style="width:165px;height:40px;margin:0 auto;display:block;"><a style="color:white;"href="scripts/shutdownAll.php">Shutdown all VM</a></button> <br>
                    <button type="button" class="btn btn-warning btn-rounded btn-fw" style="width:165px;height:40px;margin:0 auto;display:block;"><a style="color:white;"href="scripts/suspendAll.php">Suspend all VM</a></button> </br>
                    <button type="button" class="btn btn-primary btn-rounded btn-fw" style="width:165px;height:40px;margin:0 auto;display:block;"><a style="color:white;"href="scripts/summaryAll.php">Summary all VM</a></button> <br>
	                    <!--<button type="button" class="btn btn-primary btn-rounded btn-fw" style="width:165px;height:40px;margin:0 auto;display:block;"><a style="color:white;"href="scripts/shutdownAll.php">Shutdown all VM</a></button> </br>-->     
                </div>
            </div>
          </div>
          <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Single Backup</h4>
                  <p class="card-description"><i>When you have submitted the form, you can check the logs</i></p>
                  <form class="form-inline" target="_blank" action="scripts/backup.php" method="post">                  
                    <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">VMID</div>
                      </div>
                      <input required type="Number" class="form-control" name="vmid" id="inlineFormInputGroupUsername2" placeholder="Enter the VM's VMID">
                    </div>
                    <div class="form-check mx-sm-2">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Start backup</button>
                  </form>
                </div>
              </div>
            </div>
           <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Pool Backup</h4>
                <p class="card-description"><i><strong>Enter the VM VMIDs separate with a space.</strong> When you submitted the form, you can check the logs</i></p>
                <p class="card-description"><i><strong></strong></i></p>
                <form class="form-inline" target="_blank" action="scripts/backup.php" method="post">                  
                    <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text"></div>
                      </div>
                      <input type="text" pattern="[0-9 ]+" required class="form-control" name="vmid" id="inlineFormInputGroupUsername2" placeholder="Ex : 12 13 14">
                    </div>
                    <div class="form-check mx-sm-2">
                    </div>
                    <button type="submit" class="btn btn-primary mb-2">Start pool backup</button>
                </form>               
            </div>
          </div>
        </div>
      </div>
<footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">vmSafeguard © <script>new Date().getFullYear()>2010&&document.write(" - "+new Date().getFullYear());</script> <a href="https://www.bootstrapdash.com/" target="_blank">Thank's to Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Archidote Edit</span>
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
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <script src="js/data-table.js"></script>
  <script src="js/jquery.dataTables.js"></script>
  <script src="js/dataTables.bootstrap4.js"></script>
  <!-- End custom js for this page-->
</body>

<?php 
$endtime = microtime(true); // Bottom of page
$loadingIndexTimer = $endtime - $starttime ; 
$loadingIndexTimerroundedValue = round($loadingIndexTimer,2);
shell_exec('sudo sh -c \'echo "$(date) - vmSafeguard has been loaded in '.$loadingIndexTimerroundedValue.' seconds" >> /var/log/vmSafeguard-server.log\'');
// printf("Page loaded in %f seconds", $endtime - $starttime );
?>

</html>

