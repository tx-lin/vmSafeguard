for i in $(vim-cmd vmsvc/getallvms | awk '{print $1}' | grep -v Vmid); do 
vim-cmd vmsvc/get.summary $i | grep -E 'name|ip' | grep sort -r 
done
