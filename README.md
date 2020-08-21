# ESXi Web Management Tool -  Project
EWMT project has been created to facilitate the management and the VMs<b> backup </b> of an ESXi. With this tool, you will be able to backup a pool of VMs, Single Vm, Read the Backup logs etc.

Enjoy :) 

Table of contents
=
   * [Prerequisite](#bookmark_tabs-prerequisite-)
   * [Installation (Easyest way)](#pushpin-installation-easyest-12)
   * [Installation (Hand installation)](#pushpin-installation-hand-installation-22)
   * [configuration](#computer-configuration-12---on-your-server-who-host-ewmt-)
      * [Create your own ssh-key pair](##create-your-ssh-key-pair-as-root)
      * [Location for backup](#location-for-backup)
      * [Files to edit](#files-to-edit)
      * [Warning !](#warning-warning-)
   * [Web Panel](#access-to-the-web-panel)
   * [ Automating the pool backup process](##automating-the-backup-process-with-cron-tasks)
   * [Coming soon](#point_right-new-features)
   * [Common Questions](#questionspeech_balloon-notes--common-questions)
   * [Errors Code](#errors-code)

## :bookmark_tabs: Prerequisite !

- EWMT can be installed under "Debian Family". For the  devloppment of this project, I currently use Ubuntu 20.04, Php 7.4, Apache 2.4.X. To avoid unknow errors, I recommand you to use Ubuntu too.
- <b> <code> curl </code> and <code> sudo </code> command need to be install  ! </b>
- An ESXi Server operational and available trought your local network.
- All machines of your ESXi need to have the VMwareTools, without it, EWMT can't run correctly.
- SSH service activated on your ESXi
- "SSH password less" -> ssh-key pair between the two hosts for the auth.

## :pushpin: Installation (Easyest)

### Easiest Way - Run setup.sh with curl 

**WARNING**: <i>You need to be <b>root</b> or have sudo rights for executing these commands. <b>If you using debian, please enter in root privileged mode with <code> su - </code> before to run these following commands</i> </b>

Update your server before to start the installation. <code>apt update</code> 


<i> EWMT need some dependencies to work, You need to install them before setuping EWMT. </i>

```
sudo curl -sL https://raw.githubusercontent.com/brlndtech/ESXi-Web-Management-Tool/master/setup.sh | sh
``` 

## :pushpin: Installation (Hand installation)
```
sudo apt update && apt upgrade
sudo apt install git apache2 php htop wget sudo curl
sudo git clone https://github.com/brlndtech/ESXi-Web-Management-Tool
sudo mv ESXi-Web-Management-Tool /var/www/html
sudo chmod 700 -R /var/www/html/ESXi-Web-Management-Tool
sudo chown -R www-data:www-data /var/www/html/ESXi-Web-Management-Tool
sudo echo 'www-data ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers.d/myOverrides
sudo sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
sudo a2enmod ssl
sudo systemctl restart apache2
sudo a2enmod rewrite
sudo systemctl restart apache2
sudo a2ensite default-ssl.conf
sudo systemctl restart apache2
``` 

**WARNING** : <i>You need to be <b>root</b> or have sudo rights for executing these commands.</i>

## :computer: Configuration 1/2 - On your server (Who host EWMT) : 

Once you have finished the installation process, you will need to do some stuff before to edit few files of the project (previous to access to the EWMT trought http(s)). 


### Create your ssh-key pair as root

```
ssh-keygen -t rsa 
```

### Upluad your public key to the ESXi server

Before, you need to allow ssh on your ESXI, trought the <a href="https://www.tech2tech.fr/vmware-esxi-6-5-activer-lacces-ssh/">Official Web panel of ESXi Vmware</a>.

On your linux server : 

```
cd /root/.ssh/
cat id_rsa.pub | ssh -p 22 root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
# answer "yes"
# "you are connected to your esxi host"
exit
ssh -p 22 root@the-ip-of-your-esxi
# normally you are not going to provide the password
```
<b> This step is crutial for the following step. </b>

## :computer: Configuration 2/2 - On the ESXi host

### Location for backup 

On the ESXi host, you will need a specific datastore for store the futur VMs backup. In my case, I will use the datastore : <b> datastore-backup </b> as an example.

```
ssh -p 22 root@the-ip-of-your-esxi
cd /vmfs/volumes/
ls 
# your datastore will be apears" 
# your datastore is identify by an inode (datastore-backup) and an id : 
# 5e566f71-06f2da78-82d5-441ea15ee924*
cd datastore-backup

```
*name of the folder 

#### Example of the absolute path, that we will need for the next steps : </br>

<code> /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/ </code> </br>
or <br>
<code> /vmfs/volumes/datastore-backup/</code> <br>

You can use one of them, it's does not matter

### Files to edit

We need to edit .sh / .php files. Let's start with controller.php file. (Location : Root of the project)
```
nano /var/www/html/ESXi-Web-Management-Tool/controller.php
```

```
$PORT=22; // TO CHANGE 
$HOST="10.69.255.41"; // TO CHANGE, ESXi IP
$CHECKBACKUPFOLDER="ls -dt /vmfs/volumes/datastore-backup/*"; // TO CHANGE !
$LOG="/vmfs/volumes/datastore-backup/logbackup.txt"; 
// TO CHANGE, the file will be created automaticaly later
```

Save changes, and go to the sub folder scripts/. 

```
cd /var/www/html/ESXi-Web-Management-Tool/scripts
```

Patience, <b>two more edit</b>, and we can start to access to the project trought the WEB. :) 

#### The first .sh file 
``` 
nano BackupSingleVM.sh
```
<b>localize the following lines : </b>

```
PATHLOG="/vmfs/volumes/datastore-backup/logbackup.txt" 
# TO CHANGE --- Change just the name of the datastore

mkdir /vmfs/volumes/datastore-backup/backup-vm-$date 
# TO CHANGE --- Change just the name of the datastore

PATHBACKUP="/vmfs/volumes/datastore-backup/backup-vm-$date" 
# TO CHANGE --- Change just the name of the datastore 

echo -e "`ls -dt /vmfs/volumes/datastore-backup/backup*`\n" >> $PATHLOG 
# TO CHANGE --- Change just the name of the datastore

find /vmfs/volumes/datastore-backup/backup* -mtime +30 -exec rm -rf {} \; 
# TO CHANGE --- Change just the name of the datastore
# permit to delete all backup* folders > 30 Days
```
#### The second .sh file 

```
nano PoolVMBackup.sh
```
<b>localize the following lines : </b>

```
PATHLOG="/vmfs/volumes/datastore-backup/logbackup.txt" 
# TO CHANGE --- Change just the name of the datastore

mkdir /vmfs/volumes/datastore-backup/backup-vm-$date 
# TO CHANGE --- Change just the name of the datastore

PATHBACKUP="/vmfs/volumes/datastore-backup/backup-vm-$date" 
# TO CHANGE --- Change just the name of the datastore 

echo -e "`ls -dt /vmfs/volumes/datastore-backup/backup*`\n" >> $PATHLOG 
# TO CHANGE --- Change just the name of the datastore 

find /vmfs/volumes/datastore-backup/backup* -mtime +30 -exec rm -rf {} \; 
# To CHANGE --- Change just the name of the datastore 
# Permit to delete all backup* folders > 30 Days
```

<i> If you want to add some VMs in to the  "pool backup" check the following screenshot. 10 12 9 represent 3 VMID of 3 different VMs </i>

<img src="https://i.imgur.com/ZJt87Vu.jpg">




### :warning: Warning : 

Your VMs can be stored in any datastores of your ESXI, <b> BUT they need to be at the root of the datastore like <code> /vmfs/volumes/mydatastore/myVirtualMachineDebianFolder </code> <br> </b>

if it's not the case, change the value of the variable <code>"cutedpath=" </code>in the function backupVM(), you will need to edit this variable 4 times, two times in each files.  BackupSingleVM.sh / PoolVMBackup.sh.


#### That's it for the configuration of EWMT :white_check_mark: , you will be able to start EWMT trought the web

## Access to the web panel

### Authentification with .htaccess / .htpasswd

When you access to EWMT, you need to provide IDs. 

- ID : admin
- Password : helloworld

Feel free to change them ASAP :)

If you want to disable the auth process, remove .htaccess / .htpasswd (location : root of the project)

Go to http(s)://ip/ESXi-Web-Management-Tool/ (the loading takes ~ 7/8 secs)

<img src="https://i.imgur.com/efwZ78a.png">
<i> This is the welcome page of EWMT. </i> <br> <br>

 - If you want to perfom a single backup, enter the machine's vmid, and then click to submit. <b> Once you have done that, wait 2/3 secs and then you can close the tab. </b>

- Same thing for the Pool backup, but add manuelly the vmid in PoolVMBackup.sh before to answer <u>yes</u> and click to submit. <b> Once you have done that, wait 2/3 secs and then you can close the tab. </b>



<img src="https://i.imgur.com/TTRDY0D.png">
<i> Example of the shutdown section (For poweroff all the VMs of your ESXi). </i> <br> <br>
<img src="https://i.imgur.com/dNO9elw.png">
<i> Example of the summary section. Very useful part if you want to know the vmid of a VM(s) </i> <br> <br>
<img src="https://i.imgur.com/2x9XQ5R.png">
<i> ESXI stats </i> <br> <br>

## Automating the backup process with cron tasks

### With the terminal 

On the host server, edit your crontab manually <b> as root or www-data </b>

```
crontab -e 
```
Example 

```
# Every day at 23H50, PoolVMBackup.sh will be executed !
50 23 * * * /var/www/html/ESXi-Web-Management-Tool/scripts/PoolVMBackup.sh
# Executed as root
```

### With the web panel : 

You can schedule a crontask for the "PoolVMBackup.sh", with the Graphical Interface. it's more user friendly. (executed as www-data)

<img src="https://i.imgur.com/qxw9cJV.png">


Once you have submited the form, you will see the crontask (If the cron syntax has been respected)


<img src="https://i.imgur.com/8ESPDIg.png">




## :question::speech_balloon: Notes / common questions

1 - EWMT is available only for debian based OS family 

### Know Issues 
1 - If the .htaccess / .htpasswd (not crutial for the project)auth does not work, please check the apache2.conf (/etc/apache2) and replace if you did not have the same result as the following picture : 

<img src="https://i.imgur.com/BpJiX1x.png">

2 - Don't add comment into the description of a vm (not multiple line, just one line. Otherwise the " number (total) of VMs will be false" )



## Errors Code 

If you detect an error in EWMT, please open a github issue,

#### <center>Brlndtech &copy; 2020</center>

