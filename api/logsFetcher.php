<?php

switch($_POST['test']) {
   
          // powered off vm 
   case "vmAlreadyShutdown":
       shell_exec('echo "   --> '.$_POST['vmName'].' is already shutdown ($(date))" >> /var/log/vmSafeguard-server.log');
       break;
   case "vmIsCurrentlyUnderBackuping": // common to powered off and started VMs
       shell_exec('echo "     - '.$_POST['vmName'].' is currently under backuping ($(date))" >> /var/log/vmSafeguard-server.log');
       break;
   case "PercentDuringCopy": // common to powered off and started VMs
       shell_exec('echo "          '.$_POST['percent'].' % ($(date)) - Orig. folder size : '.$_POST['originSizeInGB'].' - Dest. Folder size : '.$_POST['destSizeInGB'].' " >> /var/log/vmSafeguard-server.log');
       break;
   case "vmHasBeenBackedUp": // common to powered off and started VMs
       shell_exec('echo "     - '.$_POST['vmName'].' has been backed up ($(date))" >> /var/log/vmSafeguard-server.log');
       break;
   case "vmHasBeenStartedAgain": // common to powered off and started VMs
      shell_exec('echo "   --> '.$_POST['vmName'].' has been started again ($(date))" >> /var/log/vmSafeguard-server.log');
      break; 

        // powered on vm 
   case "noVMTools":
      shell_exec('echo "   --> '.$_POST['vmName'].' does not have vmware tools, so she has been powered off (no recommanded for a vm)" >> /var/log/vmSafeguard-server.log');
      break;
   case "vmIsDyingOut":
      shell_exec('echo "   --> '.$_POST['vmName'].' is dying out, waiting before next step ($(date))" >> /var/log/vmSafeguard-server.log');
      break;

         // main program 
   case "backupProcessStart":
         shell_exec('echo "-------> VM(s) BACKUP process start on '.$_POST['hostname'].' : ($(date))" >> /var/log/vmSafeguard-server.log');
         break;
   case "wrongVMID":
         shell_exec('echo "   !!! VMID '.$_POST['VM'].' is NOT attached to any VM on this ESXi, -> It backup has been deprogrammed !!!" >> /var/log/vmSafeguard-server.log');
         break;
   case "listOfBackupFoldersTwoPoints":
         shell_exec('echo "List of present backup folder and old backup folders :" >> /var/log/vmSafeguard-server.log');
         break;
   case "listOfBackupFolders":
         shell_exec('echo "'.$_POST['list'].'" >> /var/log/vmSafeguard-server.log');
         break;
   case "endOfBackupProcess":
         shell_exec('echo "<-------- VM(s) BACKUP process end on '.$_POST['hostname'].' : ($(date))" >> /var/log/vmSafeguard-server.log');
         break;
   default:
       echo "Wrong api call";
       shell_exec('echo "$(date) - WARNING : Wrong api call (HTTP POST)" >> /var/log/vmSafeguard-server.log');
}
?>
