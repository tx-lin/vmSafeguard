<?php

require('../controller.php');

switch($_POST['test']) {
   case "mailAfterBackupProcess":
      $vmName = $_POST['vmName'] ;
      ### If you want to use your own mail sender server (SMTP Or SMTP Relay) ###
      // shell_exec('echo "Backup processs has been achieved succefully for the following VM : '.$_POST['vmName'].'" | mail -s "Backup Report vmSafeguard" '.$ADMINEMAIL.'');
      ### and comment the following line ! 
      shell_exec('curl -d "test=mailAfterBackupProcess&vmName='.$vmName.'&adminEmail='.$ADMINEMAIL.'" -X POST https://le-guide-du-secops.fr/vmsafeguard-mail-api/mail.php');
      shell_exec('echo "   --> $(date) - vmSafeguard has sent a Backup report email from https://le-guide-du-secops.fr/vmsafeguard-mail-api/mail.php" >> /var/log/vmSafeguard-server.log');
      break;
   case "ESXiAppearsToBeOffline":
      $esxiHost = $_POST['esxiHost'] ;
      shell_exec('curl -d "test=ESXiAppearsToBeOffline&esxiHost='.$esxiHost.'&adminEmail='.$ADMINEMAIL.'" -X POST https://le-guide-du-secops.fr/vmsafeguard-mail-api/mail.php');
      // a message is already writte to the local log if vmSafeguard detect an Offline ESXi.
      break;
   default:
      echo "Wrong local mail api call";
      shell_exec('echo "WARNING : Wrong mail api call (HTTP POST) $(date)" >> /var/log/vmSafeguard-server.log');
}
?>
