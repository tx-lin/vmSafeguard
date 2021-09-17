<p class="card-description"> Verify that your task has been corretly written ! Otherwise, check again the crontask syntax. </p>
<?php 
$crontaskID = random_int (100,1000 ) ;
$scriptPath = "".__DIR__."/backup.sh" ; 

    if (isset($_POST['Pool'])) {
        shell_exec("sudo echo -e \"$(crontab -u www-data -l)\n".$_POST['min']." ".$_POST['hour']." ".$_POST['dayOfMonth']." ".$_POST['month']." ".$_POST['dayOfWeek']." sudo ssh -p $PORT root@$HOST 'sh -s' < ".$scriptPath." ".$VMSAFEGUARD_IP." ".$_POST['vmid']." & # ".$crontaskID."\" | crontab -u www-data -")."</pre>";
        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
       // cron task will be stored in /var/spool/cron/crontabs/www-data
    }
    else if (isset($_POST['Single'])) {
        shell_exec("sudo echo -e \"$(crontab -u www-data -l)\n".$_POST['min']." ".$_POST['hour']." ".$_POST['dayOfMonth']." ".$_POST['month']." ".$_POST['dayOfWeek']." sudo ssh -p $PORT root@$HOST 'sh -s' < ".$scriptPath." ".$VMSAFEGUARD_IP." ".$_POST['vmid']." & # ".$crontaskID."\" | crontab -u www-data -")."</pre>";
        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
        // cron task will be stored in /var/spool/cron/crontabs/www-data
    }
    else if (isset($_POST['crontaskID'])) {
        if ($_POST['crontaskID'] == "000") {
            shell_exec("sudo rm /var/spool/cron/crontabs/www-data");
        }
        shell_exec("sudo sed -i '/".$_POST['crontaskID']."/d' /var/spool/cron/crontabs/www-data");
        echo "<pre>".shell_exec("sudo cat /var/spool/cron/crontabs/www-data")."</pre>";
    }
    else {
        echo "<pre>Wrong Crontask, try again.</pre>";
    }
?>