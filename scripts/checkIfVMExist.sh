for i in $@
do
  vim-cmd vmsvc/getallvms | awk '{print$1}' | grep $i > /dev/null
  RESULT=$?
  if [ $RESULT -eq 0 ]; then
    echo -e "VMID $i is attached to a vm ! -> The backup will be start ASAP"
  else
    echo -e "VMID $i is NOT attached to any VM on this ESXi, -> It backup has been deprogrammed"
  fi
done
echo 