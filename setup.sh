#!/bin/bash
echo -e "\e[33m The installation process of EWMT will start in few seconds ... \e[39m"
sleep 1
sudo apt -y install git apache2 php htop wget sudo curl
sudo git clone https://github.com/brlndtech/ESXi-Web-Management-Tool
sudo mv ESXi-Web-Management-Tool /var/www/html
sudo chmod 700 -R /var/www/html/ESXi-Web-Management-Tool
sudo chown -R www-data:www-data /var/www/html/ESXi-Web-Management-Tool
sudo echo 'www-data ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers.d/myOverrides # voir pour mettre les droits à un dossier, et pas à "tout"
sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf # Permit to allow .htaccess/.htpasswd
sudo a2enmod ssl
sleep 2
sudo systemctl restart apache2
sleep 4
sudo a2enmod rewrite
sleep 8
sudo a2ensite default-ssl.conf
sudo systemctl restart apache2
echo "\e[32m Done ! \e[39m"
