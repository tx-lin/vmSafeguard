for VM in $1
do
    PWR=$(vim-cmd vmsvc/power.getstate $VM | grep -v "Retrieved runtime info")
    name=$(vim-cmd vmsvc/get.config $VM | grep -i "name =" | awk '{print $3}' | head -1 | awk -F'"' '{print $2}')
    path=`find / -maxdepth 5 -name "$name.vmdk"`
    echo $path
    if [ $2 -eq 0 ]; then
        echo -e "The $name's (thin storage) is currently converting to Thick storage format" > /tmp/headDiskFormatstatus
        OUTPUT=$(vmkfstools -j $path | tee /tmp/headDiskFormatstatusInLive) & # thin -> thick
    elif [ $2 -eq 1 ]; then
        echo -e "The $name's (thick storage) is currently converting to Thin storage format" > /tmp/headDiskFormatstatus
        OUTPUT=$(vmkfstools -K $path | tee /tmp/headDiskFormatstatusInLive) & # thick -> thin 
    else 
        echo "Wrong Option"        
    fi
done