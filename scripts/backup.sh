#!/bin/sh
# --- Global Variables ---
DATASTORE="datastore1"
vmSafeguardHost="$1"
shift
timeRefreshPercentBackup="sleep 5"
hostname=$(hostname)
# --- End of global variables --- 
backupVM() {
      if [ "$PWR" == "Powered off" ] ; then
          wget --spider --post-data "test=vmAlreadyShutdown&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          wget --spider --post-data "test=vmIsCurrentlyUnderBackuping&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          path=$(find / -maxdepth 5 -name "$name.vmx")
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          PATHBACKUPa="$PATHBACKUP$name/"
          cp -r $cutedpath $PATHBACKUP &
          origin_size=$(ls -l $cutedpath | awk '{s+=$5} END {printf "%.0f\n", s}')
          origin_size_in_gb=$(du -h $cutedpath | awk '{print $1}')
          dest_size=0
          while [  $origin_size -ne $dest_size ]; do
              dest_size=$(ls -l $PATHBACKUPa | awk '{s+=$5} END {printf "%.0f\n", s}')
              dest_size_in_gb=$(du -h $PATHBACKUPa | awk '{print $1}')
              percent=$(( $dest_size*100/$origin_size ))
              wget --spider --post-data "test=PercentDuringCopy&percent=$percent&date=$date&originSizeInGB=$origin_size_in_gb&destSizeInGB=$dest_size_in_gb" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
              eval "$timeRefreshPercentBackup"
          done
          wget --spider --post-data "test=vmHasBeenBackedUp&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          vim-cmd vmsvc/power.on $VM
          wget --spider --post-data "test=vmHasBeenStartedAgain&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          wget --spider --post-data "test=mailAfterBackupProcess&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/localMailRelay.php
      else
      	  vim-cmd vmsvc/power.shutdown $VM
          result=$?
          if [ $result -ne 0 ]; then
             wget --spider --post-data "test=noVMTools&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
             vim-cmd vmsvc/power.off $VM
          fi
      	  sleep 15
          while [ "$PWR" == "Powered on" ] # Allow to the VM to shutdown securly (Especially if her want to update her os, before shutdown)
          do
            PWR=$(vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info")
            wget --spider --post-data "test=vmIsDyingOut&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
            sleep 15
          done
          wget --spider --post-data "test=vmIsCurrentlyUnderBackuping&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          path=$(find / -maxdepth 5 -name "$name.vmx")
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          PATHBACKUPa="$PATHBACKUP$name/"
          cp -r $cutedpath $PATHBACKUP &
          origin_size=$(ls -l $cutedpath | awk '{s+=$5} END {printf "%.0f\n", s}')
          origin_size_in_gb=$(du -h $cutedpath | awk '{print $1}')
          dest_size=0
          while [  $origin_size -ne $dest_size ]; do
              dest_size=$(ls -l $PATHBACKUPa | awk '{s+=$5} END {printf "%.0f\n", s}')
              dest_size_in_gb=$(du -h $PATHBACKUPa | awk '{print $1}')
              percent=$(( $dest_size*100/$origin_size ))
              wget --spider --post-data "test=PercentDuringCopy&percent=$percent&originSizeInGB=$origin_size_in_gb&destSizeInGB=$dest_size_in_gb" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
              eval "$timeRefreshPercentBackup"
          done
          wget --spider --post-data "test=vmHasBeenBackedUp&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          vim-cmd vmsvc/power.on $VM
          wget --spider --post-data "test=vmHasBeenStartedAgain&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
          wget --spider --post-data "test=mailAfterBackupProcess&vmName=$name" http://$vmSafeguardHost/vmSafeguard/api/localMailRelay.php
      fi
}
date=$(date +%d-%m-%Y-%H-%M) 
mkdir /vmfs/volumes/$DATASTORE/backup-vm-$date
PATHBACKUP="/vmfs/volumes/$DATASTORE/backup-vm-$date/" 
wget --spider --post-data "test=backupProcessStart&hostname=$hostname" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
for VM in $@
do
    vim-cmd vmsvc/getallvms | awk '{print$1}' | grep $VM > /dev/null
    result=$?
    if [ $result -ne 0 ]; then
        wget --spider --post-data "test=wrongVMID&VM=$VM" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
    else
        PWR=$(vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info")
        name=$(vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}')
        backupVM
    fi
done
wget --spider --post-data "test=listOfBackupFoldersTwoPoints" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
lsOfBackupFolders=$(ls -dt /vmfs/volumes/$DATASTORE/backup*)
wget --spider --post-data "test=listOfBackupFolders&list=$lsOfBackupFolders" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
find /vmfs/volumes/$DATASTORE/backup* -mtime +3650 -exec rm -rf {} \; 
wget --spider --post-data "test=endOfBackupProcess&hostname=$hostname" http://$vmSafeguardHost/vmSafeguard/api/logsFetcher.php
