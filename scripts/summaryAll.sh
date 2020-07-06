for i in $(vim-cmd vmsvc/getallvms | awk '{print $1}' | grep -v Vmid); do 
echo "VMID : $i"
vim-cmd vmsvc/get.summary $i | grep name
vim-cmd vmsvc/get.summary $i | grep ipAddress
vim-cmd vmsvc/get.summary $i | grep "powerState = \""
vim-cmd vmsvc/get.summary $i | grep "guestFullName = \""
echo 
done
