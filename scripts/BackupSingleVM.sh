#!/bin/sh
DATASTORE="datastore1"
backupVM() {
      if [ "$PWR" == "Powered off" ] ; then
          echo -e "   --> $name is already shutdown (`date`)\n" >> $PATHLOG
          echo -e "   - $name is currently under backuping (`date`)\n" >> $PATHLOG
          path=`find / -maxdepth 5 -name "$name.vmx"`
          # echo $path >> $PATHLOG
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          # echo $cutedpath >> $PATHLOG
          cp -r $cutedpath $PATHBACKUP
          echo -e "   - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      else
      	  vim-cmd vmsvc/power.shutdown $VM
      	  sleep 15
          while [ "$PWR" == "Powered on" ] # Allow to the VM to shutdown securly (Especially if her want to update her os, before shutdown)
          do
            PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
            echo -e "   --> $name is dying out, waiting before next step (`date`)\n" >> $PATHLOG
            sleep 15
          done
          echo -e "   - $name is currently under backuping (`date`)\n" >> $PATHLOG
          path=`find / -maxdepth 5 -name "$name.vmx"`
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          cp -r $cutedpath $PATHBACKUP
          echo -e "   - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      fi
}
date=`date +%d-%m-%Y-%H-%M`
PATHLOG="/vmfs/volumes/$DATASTORE/logsbackup.txt" # TO CHANGE --- create the file logbackup.txt to store logs info (one time)
mkdir /vmfs/volumes/$DATASTORE/backup-vm-$date # TO CHANGE --- permit to use a incremental backup
PATHBACKUP="/vmfs/volumes/$DATASTORE/backup-vm-$date" # TO CHANGE --- change data store "backup" area for your ESXI configuration 
echo -e "-------> SINGLE BACKUP process start on `hostname` : `date`\n" >> $PATHLOG
for VM in $1 
do
    PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
    name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
    backupVM
    # free to you for ad some VM...
done
echo -e "List of present backup folder and old backup folders : " >> $PATHLOG 
# TO CHANGE :         --------------------------------------------------------
echo -e "`ls -dt /vmfs/volumes/$DATASTORE/backup*`\n" >> $PATHLOG 
# TO CHANGE : -----------------------------------------------------------------------------
find /vmfs/volumes/$DATASTORE/backup* -mtime +60 -exec rm -rf {} \; # permit to delete all backup* folder > 30 Days
echo -e "<-------- SINGLE BACKUP process end on `hostname` : `date`\n" >> $PATHLOG
