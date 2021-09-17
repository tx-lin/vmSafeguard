<?php
    $HOST = htmlspecialchars($_POST['ip']) ;
    $PORT = htmlspecialchars($_POST['port']) ;
    $CHECKBACKUPFOLDER = htmlspecialchars($_POST['CheckBackupFolder']) ;
    $ADMINEMAIL = htmlspecialchars($_POST["email"]); 
    $VMSAFEGUARD_IP = htmlspecialchars($_POST["vmSafeguardIP"]) ; 

    echo "<pre>";
    if (!empty($_POST['ip']) && (!empty($_POST['port']))) {
          
        $statement = $db->prepare("UPDATE esxi SET ip = '$HOST', port = '$PORT';");
        $rows = $statement->execute();
        $rows = $statement->fetchAll();
                                        
        $statement = $db->prepare("SELECT * FROM esxi ;"); 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();

                          
        foreach ($rows as $row) {
            $HOST = htmlspecialchars($row['ip']);
            $PORT = htmlspecialchars($row['port']);
            echo "ESXi <strong>$HOST</strong> on ssh port <strong>$PORT</strong> has been added. <br>";
            shell_exec('sudo sh -c \'echo "$(date) - you have added a new ESXi to vmSafeguard IP : '.$HOST.' PORT : '.$PORT.' ! " >> /var/log/vmSafeguard-server.log\'');

        }        
    }

    if (!empty($_POST['CheckBackupFolder'])) {

        $statement = $db->prepare("UPDATE esxiPath SET CheckBackupFolder = '$CHECKBACKUPFOLDER';"); 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();

        $statement = $db->prepare("SELECT CheckBackupFolder FROM esxiPath ;"); 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();

        foreach ($rows as $row) {
            $CHECKBACKUPFOLDER = htmlspecialchars($row['CheckBackupFolder']);
            echo "Dashboard will check the latest backups with this absolute path <strong>$CHECKBACKUPFOLDER</strong> <br>";
            shell_exec('sudo sh -c \'echo "$(date) - The dashboard will check '.$CHECKBACKUPFOLDER.' for the latest backup. " >> /var/log/vmSafeguard-server.log\'');
        }
    }          
              
    if  ((!empty($_POST["email"]))) {

        $statement = $db->prepare("UPDATE users SET Email = '$ADMINEMAIL';"); 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();
                       
        $statement = $db->prepare("SELECT Email FROM users WHERE Username = 'admin' ;"); // SQLite n'est pas senssible à la casse depuis le terminal, mais depuis php si WTF !!!!! "40 minutes later..." 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();
                    
        foreach ($rows as $row) {
            $ADMINEMAIL = htmlspecialchars($row['Email']);
            echo "You have added the following admin email : <strong>$ADMINEMAIL</strong> <br>";
            shell_exec('sudo sh -c \'echo "$(date) - you have added the following admin email : '.$ADMINEMAIL.' !" >> /var/log/vmSafeguard-server.log\'');
        } 
    }
                  
    if  ((!empty($_POST["vmSafeguardIP"]))) {
        $statement = $db->prepare("UPDATE vmSafeguardHost SET Ip = '$VMSAFEGUARD_IP';"); 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();
                       
        $statement = $db->prepare("SELECT Ip FROM vmSafeguardHost WHERE Id = '1' ;"); // SQLite n'est pas senssible à la casse depuis le terminal, mais depuis php si WTF !!!!! "40 minutes later..." 
        $rows = $statement->execute();
        $rows = $statement->fetchAll();
                    
        foreach ($rows as $row) {
            $VMSAFEGUARD_IP = htmlspecialchars($row['Ip']);
            echo "You had change the vm Safeguard ip : <strong>$VMSAFEGUARD_IP</strong> <br>";
            shell_exec('sudo sh -c \'echo "$(date) - You had change the vm Safeguard ip : '.$VMSAFEGUARD_IP.'" >> /var/log/vmSafeguard-server.log\'');
        } 
    }
echo "</pre>";
echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"../\" >Reload the dashboard</a></button>"; 
?>
