j=0
for i in $(vim-cmd vmsvc/getallvms | awk '{print $1}' | grep -v Vmid); do 
	  OS=`vim-cmd vmsvc/get.summary $i | grep "windows" | cut -c18-24`
      if [ "$OS" == "windows" ] ; then
      	let "j++"
      fi
done
echo $j