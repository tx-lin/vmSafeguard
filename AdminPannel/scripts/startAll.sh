#!/bin/sh
RUNNING=0
VMS=`vim-cmd vmsvc/getallvms | grep -v Vmid | awk '{print $1}'`
for VM in $VMS ; do
     # echo "Probing VM with id: $VM."
     PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
     name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
     # echo "VM with id $VM has power state $PWR (name = $name)."
     if [ "$PWR" == "Powered off" ] ; then
          RUNNING=1
          vim-cmd vmsvc/power.on $VM > /dev/null &
          echo "$name (VMID : $VM)  has been start"
     else
          echo "WARNING : $name (VMID : $VM)  is already started !"
     fi
done
