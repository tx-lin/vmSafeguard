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
                  <form class="forms-sample" action="router.php?action=editCoreValue" method="post">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ESXi IP</label>
                      <div class="col-sm-9">
                        <input type="text" name="ip"class="form-control" id="ip" placeholder="ESXi IP (ex:10.0.0.1)">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">SSH Port</label>
                      <div class="col-sm-9">
                        <input type="number" name="port"class="form-control" id="port" placeholder="ESXi SSH Port (ex: 22)">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">vmSafeguard IP</label>
                      <div class="col-sm-9">
                        <input type="text" name="vmSafeguardIP" class="form-control" id="vmSafeguardIP" placeholder="ex : 10.0.0.10">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email"class="form-control" id="adminEmail" placeholder="example@gmail.com">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Backup folder</label>
                      <div class="col-sm-9">
                        <input type="text" name="CheckBackupFolder" class="form-control" id="CheckBackupFolder" placeholder="ex : /vfms/volumes/datastore1/">
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
                    Update your credentials.
                  </p>
                  <form class="forms-sample" action="router.php?action=updateCredentials" method="post" >
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Username</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">New Password</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">New Password again</label>
                      <div class="col-sm-9">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Password">
                      </div>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary mr-2">Save</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="col-12 grid-margin stretch-card">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Change Backup datastore (that store the backups)</h4>
                  <form class="forms-sample" action="router.php?action=ChangeBackupDatastore" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="text" name="ChangeBackupDatastore" class="form-control" required placeholder="ex : datastore1 ">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <h4 class="card-title">Refresh automatically your copy percentage (logs section) </h4>
                  <form class="forms-sample" action="router.php?action=timeRefreshPercent" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" min="5" max="3600" name="timeRefreshPercent" class="form-control" required placeholder="ex : 5">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                <h4 class="card-title">Delete old backups > x day (performed when a backup is executed)</h4>
                  <p class="card-description">
                    Win datastore space and delete old backups > x days. 
                  </p>
                  <form class="forms-sample" action="router.php?action=valueInDays" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" min="2" max="3650" name="valueInDays" class="form-control" required placeholder="ex : 365">
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
                <h4 class="card-title">Refresh automatically your dashboard every x seconds (30-7200)</h4>
                  <p class="card-description">
                    Enter only seconds value into the form. 
                  </p>
                  <form class="forms-sample" action="router.php?action=refreshTime" method="post" >
                    <div class="form-group">
                      <div class="input-group">
                        <input type="number" name="refreshTime" class="form-control" required placeholder="30">
                        <div class="input-group-append">
                          <button name="submit" class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include('scripts-footer.php') ?>
