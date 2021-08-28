#!/bin/sh
sed -i -e 's/Listen 80/Listen 80\nServerName localhost/' /etc/apache2/ports.conf
# apache2 
service apache2 start
# Start service
service cron start