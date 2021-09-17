
                  <h4 class="card-title">Current Crontab of www-data :</h4>
                  <p class="card-description">
                    <?php echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>"; ?>
                    <i> Enter the ID of the crontask that you want to delete, or fill up the form with "000", to delete the whole crontab. </i>
                  </p>
                  <form class="form-inline" action="router.php?action=saveCronTask" method="post">   
                    <label class="sr-only" for="crontaskID">Crontask ID</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">Crontask ID</div>
                      </div>
                      <input type="number" class="form-control" name="crontaskID" id="crontaskID" placeholder="Ex : 952">
                    </div>
                    <!--<div class="form-check mx-sm-2">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked>
                        Remember me
                      </label>
                    </div>-->
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                  </form>
                </div>
              </div>
            </div>

          <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Crontask (as www-data) - Scheduller, for a single VM backup</h4>
                  <p class="card-description">
                    Warning : You need to respect the <a href="https://crontab.guru/" target="_blank"> crontab </a> syntax. Otherwise, the crontask will not be written to /var/spool/crontab/www-data. 
                  </p>
                  <p class="card-description">
                  </p>
                  <form class="forms-sample" action="router.php?action=saveCronTask" method="post">
                  <input type="hidden" name="Single" value="Single">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Minutes</label>
                      <div class="col-sm-9">
                        <input type="text" name="min"class="form-control" id="min"  required placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Hour</label>
                      <div class="col-sm-9">
                        <input type="text" name="hour"class="form-control" id="hour" required placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Day of month</label>
                      <div class="col-sm-9">
                        <input type="text" name="dayOfMonth"class="form-control" required id="dayOfMonth" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Month</label>
                      <div class="col-sm-9">
                        <input type="text" name="month"class="form-control" required id="month" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Day of week</label>
                      <div class="col-sm-9">
                            <select name="dayOfWeek"class="form-control">
                              <option value="*" >All days</option>
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
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Vmid of the VM</label>
                      <div class="col-sm-9">
                        <input type="number" name="vmid" class="form-control" id="vmid" placeholder=" ex : 23">
                      </div>
                    </div>
                    <button type="submit" name="submit" target="_blank" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Crontask (as www-data) - Scheduller, for a "Pool Backup" of the VMs</h4>
                  <p class="card-description">
                    Warning : You need to respect the <a href="https://crontab.guru/" target="_blank"> crontab </a> syntax. Otherwise, the crontask will not be written to /var/spool/crontab/www-data. 
                  </p>
                  <p class="card-description">
                  </p>
                  <form class="forms-sample" action="router.php?action=saveCronTask" method="post">
                    <input type="hidden" name="Pool" value="Pool">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Minutes</label>
                      <div class="col-sm-9">
                        <input type="text" name="min"class="form-control" id="min"  required placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Hour</label>
                      <div class="col-sm-9">
                        <input type="text" name="hour"class="form-control" id="hour" required placeholder="10">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputMobile" class="col-sm-3 col-form-label">Day of month</label>
                      <div class="col-sm-9">
                        <input type="text" name="dayOfMonth"class="form-control" required id="dayOfMonth" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Month</label>
                      <div class="col-sm-9">
                        <input type="text" name="month"class="form-control" required id="month" placeholder="*">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="exampleInputConfirmPassword2" class="col-sm-3 col-form-label">Day of week</label>
                      <div class="col-sm-9">
                            <select name="dayOfWeek"class="form-control">
                              <option value="*" >All days</option>
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
                    <div class="form-group row">
                      <label for="exampleInputPassword2" class="col-sm-3 col-form-label">Vmids of the VMs</label>
                      <div class="col-sm-9">
                        <input type="text" pattern="[0-9 ]+" name="vmid" class="form-control" id="vmid" placeholder=" ex : 12 13 14 15">
                      </div>
                    </div>
                    <button type="submit" name="submit" target="_blank" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
