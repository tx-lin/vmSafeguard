#!/bin/sh
values=$(df -h | awk {'print $5'} | sed -e 1d | sed 's/\%//g')
for value in $values 
do
  if [  $value -ge "80" ]; then
    let "y=100-$value"
    echo "The following datastore space is under 80% of it capacity. $y go left $(df -h | grep $value | awk '{print$6}')"
  fi
done 