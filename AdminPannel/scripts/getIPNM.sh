#!/bin/sh
esxcfg-vmknic -l | sed 's/\|/ /'| awk '{print $4}' | head -2 | tail -1 # IP 
echo  " Netmask : `esxcfg-vmknic -l | sed 's/\|/ /'| awk '{print $5}' | head -2 | tail -1`" # Netmask
