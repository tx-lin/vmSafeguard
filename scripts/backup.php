<?php
    if (isset($_POST['vmid'])) {
        echo "<pre>".shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < checkIfVMExist.sh ".$_POST['vmid']."")."";
        shell_exec("sudo ssh -p $PORT root@$HOST 'sh -s' < backup.sh ".$VMSAFEGUARD_IP." ".$_POST['vmid']." > /dev/null 2>/dev/null &");
        sleep (1);
        $CHECKBACKUPFOLDER="".$CHECKBACKUPFOLDER."backup*";
        echo "New root backup folder has been created to welcome VM(s) backup : ".shell_exec("sudo ssh -p $PORT root@$HOST 'ls -dt1 $CHECKBACKUPFOLDER | head -n 1 '")."</pre>";
        echo "<button class=\"btn btn-primary mt-2 mt-xl-0\"><a style=\"color:white;\"href=\"router.php?action=showLogs#footer\" >Latest logs</a></button>";
    }
    else {
        echo "<pre> WARNING = One or more VMIDs that you have entered is not attached to any VM. </pre>";
    }
?>
