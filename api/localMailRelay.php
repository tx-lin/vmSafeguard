<?php

require('../controller.php');

switch($_POST['test']) {
   case "mailAfterBackupProcess":
      $vmName = $_POST['vmName'] ;
      ### If you want to use your own mail sender server (SMTP Or SMTP Relay) ###
      // shell_exec('echo "Backup processs has been achieved succefully for the following VM : '.$_POST['vmName'].'" | mail -s "Backup Report vmSafeguard" '.$ADMINEMAIL.'');
      ### and comment the following line ! 
      shell_exec('curl -d "test=mailAfterBackupProcess&vmName='.$vmName.'&adminEmail='.$ADMINEMAIL.'" -X POST https://le-guide-du-sysops.fr/vmsafeguard-mail-api/mail.php');
      shell_exec('sudo sh -c \'echo "   --> $(date) - vmSafeguard has sent a Backup report email from https://le-guide-du-sysops.fr/vmsafeguard-mail-api/mail.php" >> /var/log/vmSafeguard-server.log\'');
      break;
   default:
      echo "Wrong local mail api call";
      shell_exec('sudo sh -c \'echo "WARNING : Wrong mail api call (HTTP POST) $(date)" >> /var/log/vmSafeguard-server.log\'');
}
?>
