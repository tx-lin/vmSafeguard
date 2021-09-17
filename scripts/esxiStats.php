<?php 
// backend 
    $countVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'vim-cmd vmsvc/getallvms | tail -n +2 | wc -l'");
    $poweredOnVMs = shell_exec("sudo ssh -p $PORT root@$HOST 'esxcli vm process list | grep \"World ID\" | wc -l'");
    $shutdownVMs = intval($countVMs) - intval($poweredOnVMs) ;  
    $osWindows = shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < detectOS.sh");
  	echo "<input type=\"hidden\" id=\"esxiVMs\" name=\"esxiVMs\" value=\"$countVMs\"/>";
   	echo "<input type=\"hidden\" id=\"esxiStartedVMs\" name=\"esxiStartedVMs\" value=\"$poweredOnVMs\"/>";
   	echo "<input type=\"hidden\" id=\"esxiPoweredOffVMs\" name=\"esxiPoweredOffVMs\" value=\"$shutdownVMs\"/>";
    echo "<input type=\"hidden\" id=\"vmOSWindows\" name=\"whichOs\" value=\"$osWindows\"/>";
?>
      <!-- partial -->

          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">VMs stats graphe</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">% OS kind  </h4>
                  <canvas id="doughnutChart"></canvas>
                  </div>
              </div>
            </div>
          </div>
