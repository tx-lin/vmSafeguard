theVmid=`vim-cmd vmsvc/getallvms | grep -i "$1" | awk '{print $1}' | head -1`
vim-cmd vmsvc/get.summary $theVmid | grep "vm = 'vim.VirtualMachine:"
vim-cmd vmsvc/get.summary $theVmid | grep name
vim-cmd vmsvc/get.summary $theVmid | grep ipAddress
vim-cmd vmsvc/get.summary $theVmid | grep "toolsStatus = "
vim-cmd vmsvc/get.summary $theVmid | grep "powerState = \""
vim-cmd vmsvc/get.summary $theVmid | grep "guestFullName = \""
