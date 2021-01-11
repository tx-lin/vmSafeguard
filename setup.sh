#!/bin/bash
echo -e "\e[33m The installation process of EWMT will start in few seconds ... \e[39m"
sleep 1
sudo apt -y install git apache2 php sqlite3 php-sqlite3 htop wget sudo curl
sudo git clone https://github.com/brlndtech/vmSafeguard
sudo mv vmSafeguard /var/www/html
sudo chmod 700 -R /var/www/html/vmSafeguard
sudo chown -R www-data:www-data /var/www/html/vmSafeguard # seulement l'utilisateur www:data et son grp aura des droits RWX, pour exec les scripts.php / ewmt.db
sudo echo 'www-data ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers.d/myOverrides # voir pour mettre les droits à un dossier, et pas à "tout"
sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf # Permit to allow .htaccess/.htpasswd
sudo a2enmod ssl
sleep 2
sudo systemctl restart apache2
sleep 2
sudo a2enmod rewrite
sleep 2
sudo a2ensite default-ssl.conf
sudo systemctl restart apache2
sleep 2
sudo systemctl enable apache2
echo -e "\e[32m Done !\e[39m"
