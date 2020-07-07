#!/bin/sh
backupVM() {
      if [ "$PWR" == "Powered off" ] ; then
          echo -e "   --> $name is already shutdown (`date`)\n" >> $PATHLOG
          echo -e "   - $name is currently under backuping (`date`)\n" >> $PATHLOG
          path=`find / -name "$name.vmx"`
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          cp -r $cutedpath $PATHBACKUP
          echo -e "   - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      else
      	  vim-cmd vmsvc/power.shutdown $VM
          while [ "$PWR" == "Powered on" ] # Allow to the VM to shutdown securly (Especially if her want to update her os, before shutdown) 
          do
            PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
            echo -e "   --> $name is dying out, waiting before next step (`date`)\n" >> $PATHLOG
            sleep 15
          done
          echo -e "   - $name is currently under backuping (`date`)\n" >> $PATHLOG
          path=`find / -name "$name.vmx"`
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          cp -r $cutedpath $PATHBACKUP
          echo -e "   - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   --> $name has been started again (`date`)\n" >> $PATHLOG
      fi
}
date=`date +%d-%m-%Y`
PATHLOG="/vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/scripts/logbackup.txt"
mkdir /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/backup-vm-$date # TO CHANGE --- permit to use a incremental backup
PATHBACKUP="/vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/backup-vm-$date" # TO CHANGE --- change data store "backup" area for your ESXI configuration 
VMS=`vim-cmd vmsvc/getallvms | grep -v Vmid | awk '{print $1}'` # VMF = VMIDs of each virtual machines 
echo -e "-------> Backup process start : `date`\n" >> $PATHLOG
for VM in $VMS ; do
     PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
     name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
    if [ "$VM" == "18" ] ; then
      backupVM
    fi
    if [ "$VM" == "19" ] ; then
      backupVM
    fi
    # free to you for ad some VM...
done
echo -e "List of present backup folder and old backup folders : " >> $PATHLOG 
# TO CHANGE :         --------------------------------------------------------
echo -e "`ls -dt /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/backup*`\n" >> $PATHLOG 
# TO CHANGE : -----------------------------------------------------------------------------
find /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/backup* -mtime +30 -exec rm -rf {} \; # permit to delete all backup* folder > 60 Days
echo -e "<-------- Backup process end : `date`\n" >> $PATHLOG