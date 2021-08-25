#!/bin/sh
echo  "IP :  $(esxcli network ip interface ipv4 get | sed 's/\|/ /'| awk '{print $2}' | tail -1), " 
echo  "Net Mask :  $(esxcli network ip interface ipv4 get | sed 's/\|/ /'| awk '{print $3}' | tail -1)"
