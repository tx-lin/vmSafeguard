#!/bin/sh
RUNNING=0
VMS=`vim-cmd vmsvc/getallvms | grep -v Vmid | awk '{print $1}'` # VMF = VMIDs of each virtual machines
i=0
for VM in $VMS ; do
     # echo "Probing VM with id: $VM."
     PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
     name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
     # echo "VM with id $VM has power state $PWR (name = $name)."
    if [ "$PWR" == "Suspended" ] ; then
       let "i++"
    fi
done
echo $i