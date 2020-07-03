#!/bin/sh
# this file need to upluad to your ESXI server !
backupVM() {
      if [ "$PWR" == "Powered off" ] ; then
          RUNNING=1
          echo -e "   - $name is currently under backuping (`date`)\n" >> $PATHLOG
          path=`find / -name "$name.vmx"`
          # echo $path
          # echo -n "$name" | wc -m
          cutedpath="${path%"${path#/*/*/*/*/}"}"
          # echo $cutedpath
          cp -r $cutedpath $PATHBACKUP
          # vim-cmd vmsvc/power.on $VM (une fois que la sauvegarde est ok, on redemarre la machine ?)
          echo -e "   - $name has been backed up (`date`)\n" >> $PATHLOG 
          vim-cmd vmsvc/power.on $VM
          echo -e "   - $name has been started again (`date`)\n" >> $PATHLOG
      fi
}
date=`date +%d-%m-%Y`
PATHLOG="/vmfs/volumes/esxi-system/scripts/logbackup.txt"
mkdir /vmfs/volumes/5cfe12b0-748ad9ba-9a3b-10604b84260f/backup-vm-$date # TO CHANGE --- permit to use a incremental backup
PATHBACKUP="/vmfs/volumes/5cfe12b0-748ad9ba-9a3b-10604b84260f/backup-vm-$date" # TO CHANGE --- change data store "backup" area for your ESXI configuration 
RUNNING=0
VMS=`vim-cmd vmsvc/getallvms | grep -v Vmid | awk '{print $1}'` # VMF = VMIDs of each virtual machines 
echo -e "-------> Backup process start : `date`\n" >> $PATHLOG
for VM in $VMS ; do
     PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
     name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
    if [ "$VM" == "$1" ] ; then
      backupVM
    fi
    # free to you for ad some VM...
done
echo -e "List of present backup folder  and old backup folders : " >> $PATHLOG 
# TO CHANGE :         --------------------------------------------------------
echo -e "`ls -dt /vmfs/volumes/5cfe12b0-748ad9ba-9a3b-10604b84260f/backup*`\n" >> $PATHLOG 
# TO CHANGE : -----------------------------------------------------------------------------
find /vmfs/volumes/5cfe12b0-748ad9ba-9a3b-10604b84260f/backup* -mtime +60 -exec rm -rf {} \; # permit to delete all backup* folder > 60 Days
echo -e "<-------- Backup process end : `date`\n" >> $PATHLOG