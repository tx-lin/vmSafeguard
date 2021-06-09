<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Settings</title>
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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add an ESXi to vmSafeguard database.</h4>
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
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">User settings</h4>
                  <p class="card-description">
                    Update your credentials
                  </p>
                  <form class="forms-sample" action="updateCredentials.php" method="post" >
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ID</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" required id="exampleInputUsername2" name="username" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" required id="exampleInputPassword2" name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">New Password again</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" required id="exampleInputConfirmPassword2" name="password2" placeholder="Password">
                      </div>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary mr-2">Save</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 grid-margin stretch-card">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Refresh automatically your dashboard every x seconds (30-7200)</h4>
                  <p class="card-description">
                    Enter only a seconds value into the form 
                  </p>
                  <form class="forms-sample" action="refreshTime.php" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" min="30" max="7200" name="refreshTime" class="form-control" required placeholder="30">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Time for update the percent % progression during a backup </h4>
                  <p class="card-description">
                    This form will be update the backup.sh file. 
                  </p>
                  <form class="forms-sample" action="timeForSyncPercentProgressionBackup.php" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" min="1" max="3600" name="timeRefreshPercent" class="form-control" required placeholder="Value between 10 - 3600">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 grid-margin stretch-card">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Delete old backups > x day (performed when a backup is executed)</h4>
                  <p class="card-description">
                    Win datastore space and delete old backups > x days. 
                  </p>
                  <form class="forms-sample" action="changeValueForDeleteOldBackup.php" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" min="2" max="3650" name="valueInDays" class="form-control" required placeholder="60">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Convert a virtual disk from Thick to Thin and vice versa</h4>
                  <p class="card-description">
                    First input : VMID VM Second Input : enter 0 if you want convert Thin -> thick. 1 for the reverse 
                  </p>
                  <form class="form-inline" action="changeDiskFormat.php" method="post">
                    <label class="sr-only" for="inlineFormInputName2">Name</label>
                    <input type="text" name="vmid" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="VMID">
                    <input type="text" name="changeDiskFormat" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="0 = Thin 1 = thick">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include('scripts-footer.php') ?>
