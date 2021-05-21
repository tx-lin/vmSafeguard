#!/bin/sh
VMS=`vim-cmd vmsvc/getallvms | grep -v Vmid | awk '{print $1}'`
for VM in $VMS ; do
     # echo "Probing VM with id: $VM."
     PWR=`vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info"`
     name=`vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}'` 
     # echo "VM with id $VM has power state $PWR (name = $name)."
     if [ "$PWR" == "Powered on" ] ; then
          vim-cmd vmsvc/power.shutdown $VM
          result=$?
          if [ $result -ne 0 ]; then
             vim-cmd vmsvc/power.off $VM
             echo "$name (VMID : $VM) has been powered off. Warning, it's not a securely shutdown ! Install ASAP vmware tools on this machine."
          else
             echo "$name (VMID : $VM) has been shutdown"
          fi
     else
          echo "WARNING : $name (VMID : $VM) is already shutdown !"
     fi
done
