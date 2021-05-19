#!/bin/sh
DATASTORE="datastore1"
timeRefreshPercentBackup="sleep 5"
backupVM() {
      if [ "$PWR" == "Powered off" ] ; then
          echo -e "   --> $name is already shutdown (`date`)\n" >> $PATHLOG
          echo -e "     - $name is currently under backuping (`date`)" >> $PATHLOG
          path=`find / -maxdepth 5 -name "$name.vmx"`
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
              date=$(date +%d-%m-%Y-%H-%M)
              echo -e "          $percent % ($date) - Orig. folder size : $origin_size_in_gb - Dest. Folder size : $dest_size_in_gb" >> $PATHLOG
              eval "$timeRefreshPercentBackup"
          done
          echo -e "     - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      else
      	  vim-cmd vmsvc/power.shutdown $VM
          result=$?
          if [ $result -ne 0 ]; then
             echo -e "   Warning, $name does not have vmware tools, so she has been poweroff (it's not a securely shutdown !)\n" >> $PATHLOG
             vim-cmd vmsvc/power.off $VM
          fi
      	  sleep 15
          while [ "$PWR" == "Powered on" ] # Allow to the VM to shutdown securly (Especially if her want to update her os, before shutdown)
          do
            PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
            echo -e "   --> $name is dying out, waiting before next step (`date`)\n" >> $PATHLOG
            sleep 15
          done
          echo -e "     - $name is currently under backuping (`date`)" >> $PATHLOG
          path=`find / -maxdepth 5 -name "$name.vmx"`
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
              date=$(date +%d-%m-%Y-%H-%M)
              echo -e "          $percent % ($date) - Orig. folder size : $origin_size_in_gb - Dest. Folder size : $dest_size_in_gb" >> $PATHLOG
              eval "$timeRefreshPercentBackup"
          done
          echo -e "     - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      fi
}
date=`date +%d-%m-%Y-%H-%M`
PATHLOG="/vmfs/volumes/$DATASTORE/logsbackup.txt" 
mkdir /vmfs/volumes/$DATASTORE/backup-vm-$date
PATHBACKUP="/vmfs/volumes/$DATASTORE/backup-vm-$date/" 
echo -e "-------> VM(s) BACKUP process start on `hostname` : `date`\n" >> $PATHLOG
for VM in $@
do
    vim-cmd vmsvc/getallvms | awk '{print$1}' | grep $VM > /dev/null
    result=$?
    if [ $result -ne 0 ]; then
        echo -e "   !!! VMID $VM is NOT attached to any VM on this ESXi, -> It backup has been deprogrammed !!!\n " >> $PATHLOG
    else
        PWR=$(vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info")
        name=$(vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}')
        backupVM
    fi
done
echo -e "List of present backup folder and old backup folders : " >> $PATHLOG 
echo -e "$(ls -dt /vmfs/volumes/$DATASTORE/backup*)\n" >> $PATHLOG 
find /vmfs/volumes/$DATASTORE/backup* -mtime +180 -exec rm -rf {} \;
echo -e "<-------- VM(s) BACKUP process end on $(hostname) : $(date)\n" >> $PATHLOG