<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>vmSafeguard | Update credentials </title>
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
<?php 
include('scripts-menu-header-top-left.php');
require ('../connexionpdo.php');
?>
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">vmSafeguard | Update your credentials</h4>
                  <p class="card-description">                
                    <?php

                        if ((!empty($_POST["password"])) && (!empty($_POST["password2"])))
                            if ($_POST["password"] == $_POST["password2"]) {
                                if (!empty($_POST["username"])) {
                                    shell_exec("htpasswd -nbB ".$_POST['username']." ".$_POST['password']." > ../.htpasswd"); // B = pour bcrypt, nouvel fonction de hashage sécurisé ++ <=> sha1, md5 crypt : Cette commande est exec par www:data
                                    shell_exec('sudo sh -c \'echo "$(date) - your credentials has been updated ! " >> /var/log/vmSafeguard-server.log\'');
                                    echo "<pre>Credentials has been updated ".$_POST['username']." ! <br></pre>";
                                } else {
                                    echo "<pre> ERROR : Provide a username (current or an other) to change your password ! </pre>";
                                }                                    
                            } else {
                                  echo "<pre> ERROR : The passwords provided are not the same ! </pre>";
                                  shell_exec('sudo sh -c \'echo "$(date) - WARNING your credentials has not been updated, because the password checking has failed ! " >> /var/log/vmSafeguard-server.log\'');
                            }
                            
                        if  ((!empty($_POST["email"]))) {
                            $email = $_POST["email"]; 

                            $statement = $db->prepare("UPDATE users SET Email = '$email';"); 
                            $rows = $statement->execute();
                            $rows = $statement->fetchAll();
                               
                            $statement = $db->prepare("SELECT Email FROM users WHERE Username = 'admin' ;"); // SQLite n'est pas senssible à la casse depuis le terminal, mais depuis php si WTF !!!!! "40 minutes later..." 
                            $rows = $statement->execute();
                            $rows = $statement->fetchAll();
                            
                            foreach ($rows as $row) {
                              $email= $row['Email'];
                              echo "<pre> You have updated the admin email ($email) ! <br></pre>";
                            } 
                        }



                        echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('scripts-footer.php') ?>