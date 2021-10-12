#!/bin/bash
function setup () {
    echo -e "\e[32m-----> vmSafeguard (version : $1) installation is starting ...\e[39m"
    sleep 3
    sudo apt -y install git apache2 php sqlite3 php-sqlite3 htop wget sudo curl
    sudo git clone --branch $1 https://github.com/archidote/vmSafeguard
    sudo mv vmSafeguard /var/www/html
    sudo chmod 700 -R /var/www/html/vmSafeguard
    sudo chown -R www-data:www-data /var/www/html/vmSafeguard
    sudo echo 'www-data ALL=(ALL) NOPASSWD: /usr/bin/ssh, /usr/bin/cat, /usr/bin/crontab, /usr/bin/echo, /usr/bin/rm, /usr/bin/sed' >> /etc/sudoers.d/myOverrides
    sudo touch /var/log/vmSafeguard-server.log
    sudo chown www-data:www-data /var/log/vmSafeguard-server.log
    sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
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
    echo -e "\e[32mDone !\e[39m"
}

case $1 in
    "6.x")
	    branch="6.1.1"
        setup $branch
        ;;
    *)
	    branch="master"
        setup $branch
        ;;
esac