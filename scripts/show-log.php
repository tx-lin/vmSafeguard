<?php 
require('../controller.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Log Section</title>
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
<?php include('scripts-menu-header-top-left.php'); ?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Log Section (display the 500 last lines) </h4>
                  <button class="btn btn-primary mt-2 mt-xl-0"><a style="color:white;"href="#footer" >Latest logs</a></button>
                  <p class="card-description">
                      <?php echo "<pre>".shell_exec("sudo sh -c 'cat /var/log/vmSafeguard-server.log | tail -1000 '")."</pre>";
                      // Nous devons préfixer notre commande avec sudo sh -c '<final cmd>', car nous avons besoin de nous élever en privilège, 
                      //pour lire le contenu du fichier de log de vmSafeguard, qui de base est seulement lisible par root (sauf si on est un 
                      // membre qui dispose de droit sudoers comme notre utilisateur www-data dans le cas de vmSafeguard.)
                      ?>
                      <button class="btn btn-primary mt-2 mt-xl-0"><a style="color:white;"href="#head" >Oldest logs</a></button>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
<?php include('scripts-footer.php') ?>
                      <!-- <script>
                        fetch('../api/vmSafeguard-server.log')
                          .then(response => response.text())
                          .then(data => {
                            
                            document.write.innerHTML(data);
                          });
                      </script> -->