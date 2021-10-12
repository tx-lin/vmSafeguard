<?php
    if ((!empty($_POST["password"])) && (!empty($_POST["password2"]))) {
        if ($_POST["password"] == $_POST["password2"]) {
            if (!empty($_POST["username"])) {
                shell_exec("htpasswd -nbB ".$_POST['username']." ".$_POST['password']." > ../.htpasswd"); // B = pour bcrypt, nouvel fonction de hashage sécurisé ++ <=> sha1, md5 crypt : Cette commande est exec par www:data
                shell_exec('echo "$(date) - your credentials has been updated ! " >> /var/log/vmSafeguard-server.log');
                echo "<pre>Credentials has been updated <strong>".$_POST['username']."</strong> ! <br></pre>";
            } 
            else {
                echo "<pre> ERROR : Provide a username (current or an other) to change your password ! </pre>";
            }                                    
        } 
        else {
            echo "<pre> ERROR : The passwords provided are not the same ! </pre>";
            shell_exec('echo "$(date) - WARNING your credentials has not been updated, because the password checking has failed ! " >> /var/log/vmSafeguard-server.log');
          }
    }

    echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>";
?>