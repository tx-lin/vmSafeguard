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
<?php include('scripts-menu-header-top-left.php');?>
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
                        // Ancienne méthode avec sha1, qui apparement est moins sécurisé. 
                        /* $user = "adm" ;
                        $password = "123+aze";
                        $hashedPasswd = '{SHA}' . base64_encode(sha1($password, TRUE));
                        exec("echo ".$user.":".$hashedPasswd." > .htpasswd");
                        */
                        if (isset($_POST["submit"])) {
                            if ($_POST["password"] == $_POST["password2"]) {

                                exec("htpasswd -nbB ".$_POST['username']." ".$_POST['password']." > ../.htpasswd"); // B = pour bcrypt, nouvel fonction de hashage sécurisé ++ <=> sha1, md5 crypt : Cette commande est exec par www:data
                                echo "<pre>Credentials has been updated ".$_POST['username']." ! <br></pre>";
                                echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
                            }
                            else {
                                echo "<pre> The passwords provided are not the same ! </pre>";
                            }
                        }
                    ?>
                </div>
              </div>
            </div>
          </div>
        </div>
<?php include('scripts-footer.php') ?>