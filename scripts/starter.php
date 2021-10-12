
                  <p class="card-description">
                    Before to complete the form, don't forget to add your public ssh key to the ESXi. follow the <a href="https://github.com/archidote/vmSafeguard/blob/master/README.md" target="_blank">documentation</a>, if you don't know how to do that. 
                  </p>
                  <form class="forms-sample" action="router.php?action=editCoreValue" method="post">
                    <div class="form-group row">
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">ESXi IP</label>
                      <div class="col-sm-9">
                        <input type="text" name="ip"class="form-control" id="ip" required placeholder="ex : 10.0.0.1">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">SSH Port</label>
                      <div class="col-sm-9">
                        <input type="number" name="port"class="form-control" id="port" required placeholder="ESXi SSH Port (ex: 22)">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Backup folder</label>
                      <div class="col-sm-9">
                        <input type="text" name="CheckBackupFolder"class="form-control" id="CheckBackupFolder" required placeholder="ex : /vfms/volumes/datastore1/">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Admin Email</label>
                      <div class="col-sm-9">
                        <input type="email" name="email"class="form-control" id="adminEmail" required placeholder="">
                      </div>
                      <label for="exampleInputUsername2" class="col-sm-3 col-form-label">vmSafeguard IP</label>
                      <div class="col-sm-9">
                        <input type="text" name="vmSafeguardIP" class="form-control" id="vmSafeguardIP" required placeholder="ex : 10.0.0.10">
                      </div>
                    </div>
                    <button type="submit" name="submit" target="_blank" class="btn btn-primary mr-2">Submit</button>
                  </form>