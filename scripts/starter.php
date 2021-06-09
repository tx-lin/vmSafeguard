<!DOCTYPE html>
<html lang="en">
<head>
  <!-- required maxlength="2" meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Schedulle a crontask</title>
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
<?php include('scripts-menu-header-top-left.php'); ?>
    <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Welcome ! </h4>
                  <p class="card-description">
                    <i> Add an ESXi to vmSafeguard database.</i>
                  </p>
                  <p class="card-description">
                    Before to complete the form, don't forget to add your public ssh key to the ESXi. follow the <a href="https://github.com/archidote/vmSafeguard/blob/master/README.md" target="_blank">documentation</a>, if you don't know how to do that. 
                  </p>
                  <form class="forms-sample" action="firstConnexion.php" method="post">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ESXi IP</label>
                      <div class="col-sm-9">
                        <input type="text" name="ip"class="form-control" id="ip" required placeholder="ESXi IP (ex:10.0.0.1)">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">SSH Port</label>
                      <div class="col-sm-9">
                        <input type="number" name="port"class="form-control" id="port" required placeholder="ESXi SSH Port (ex: 22)">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Backup folder</label>
                      <div class="col-sm-9">
                        <input type="text" name="CheckBackupFolder"class="form-control" id="CheckBackupFolder" required placeholder="ex : /vfms/volumes/datastore1/">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Logs Path</label>
                      <div class="col-sm-9">
                        <input type="text" name="LogsPath"class="form-control" id="LogsPath" required placeholder="ex : /vfms/volumes/datastore1/logsbackup.txt">
                      </div>
                    </div>
                    <button type="submit" name="submit" target="_blank" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php
include('scripts-footer.php');
?>