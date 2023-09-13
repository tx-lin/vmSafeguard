<?php
// à facto ! 
switch($_POST['test']) {
   case "mailAfterBackupProcess":
      $from = "user@example.com";
      $to = $_POST['adminEmail'];
      $subject = "Backup Report - vmSafeguard";
      $message = 'Backup processs has been achieved succefully for the following VM : '.$_POST['vmName'].'';
      $headers = "From :" . $from;
      echo $_POST['adminEmail'];
      echo $_POST['vmName'] ; 
      mail($to,$subject,$message, $headers);
      break;
   case "ESXiAppearsToBeOffline" :
      $from = "user@example.com";
      $to = $_POST['adminEmail'];
      $subject = "Connectivity Report - vmSafeguard";
      $message = 'WARNING vmSafeguard has detected that your ESXi '.$_POST['esxiHost'].' appears to be offline';
      $headers = "From :" . $from;
      echo $_POST['adminEmail'];
      echo $_POST['esxiHost'] ; 
      mail($to,$subject,$message, $headers);
      break; 
   default:
      echo "Wrong remote mail api call";
}
?>
