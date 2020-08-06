<?php 
require('../controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- required maxlength="2" meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EWMT | Schedulle a crontask</title>
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
?>    <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Crontask (as www-data) - Scheduller, for a "Pool Backup" of the VMs</h4>
                  <p class="card-description">
                    Warning : You need to respect the <a href="https://crontab.guru/" target="_blank"> crontab </a> syntax. Otherwise, the crontask will not be written to /var/spool/crontab/www-data. 
                  </p>
                  <p class="card-description">
                    <i> The crontask will be execute the following script : <strong> PoolVMBackup.sh </strong> </i>
                  </p>
                  <form class="forms-sample" action="saveCronTask.php" method="post">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Minutes</label>
                      <div class="col-sm-9">
                        <input type="text" required maxlength="2" name="min"class="form-control" id="min"  placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Hour</label>
                      <div class="col-sm-9">
                        <input type="text" required maxlength="2" name="hour"class="form-control" id="hour" placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Day of month</label>
                      <div class="col-sm-9">
                        <input type="text" required maxlength="2" name="dayOfMonth"class="form-control" id="dayOfMonth" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Month</label>
                      <div class="col-sm-9">
                        <input type="text" required maxlength="2" name="month"class="form-control" id="month" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Day of week</label>
                      <div class="col-sm-9">
                            <select name="dayOfWeek"class="form-control">
                              <option value="1" >Monday</option>
                              <option value="2" >Tuesday</option>
                              <option value="3" >Wednesday</option>
                              <option value="4" >Thursday</option>
                              <option value="5" >Friday</option>
                              <option value="6" >Saturday</option>
                              <option value="7" >Sunday</option>
                            </select>  
                      </div>
                    </div>
                    <button type="submit" target="_blank" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
<?php
include('scripts-footer.php');
?> 
