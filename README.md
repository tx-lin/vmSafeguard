# ESXi Web Management Tool -  Project 
EWMT project has been create to 
facilitate the management of an ESXi espially for Group (VMs) actions and group vm backuping 

## :bookmark_tabs: Prerequisite !

- EWMT can be installed under "Debian Family". For the  devloppment of this project, I currently use Ubuntu 20.04
- ESXi(s) Server operational and available trought your local network :) 
- All machines of your ESXi need to have the VMwareTools, without it, EWMT can't be a run correctly 
- SSH service activated in your ESXi

## :pushpin: Installation (Easyest) 1/2

### Easiest Way - Run setup.sh with curl 
<i> EWMT need some dependencies to work, You need to install of them before setuping EWMT. </i>

```
curl -sL https://raw.githubusercontent.com/brlndtech/Beta-ESXi-Management-Tool/master/setup.sh | sh
``` 

## :pushpin: Installation (Hand installation) 2/2
```
sudo apt install git apache2 php htop wget
sudo git clone https://github.com/brlndtech/ESXi-Web-Management-Tool
sudo mv ESXi-Web-Management-Tool /var/www/html
sudo chmod 700 -R /var/www/html/ESXi-Web-Management-Tool
sudo chown -R www-data:www-data /var/www/html/ESXi-Web-Management-Tool
sudo echo 'www-data ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers.d/myOverrides
```

**WARNING** : You need to be <b>root</b> or have sudo rights for executing these commands. 

## :computer: Configuration
#

Once you have finished the installation process, you will need to do some stuff before edit some files of the project (previous to access to the EWMT trought http). 

### On your Server (Who host EWMT) : 

### Create your ssh-key pair 

```
ssh-keygen -t rsa 
```

### Upluad your public key to the ESXi server

<b> Before, you need to allow ssh on your ESXI, trought the Web Pannel. https://www.tech2tech.fr/vmware-esxi-6-5-activer-lacces-ssh/</b>

```
# on the server
cd /root/.ssh/
cat id_rsa.pub | ssh root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
# answer "yes"
# "you are connected to your esxi host"
exit
ssh -p 22 root@the-ip-of-your-esxi
# normally you are not going to provide the password
```
<b> This step is crutial for the following step. </b>

### Backup folder(s)

On the ESXi host, you will need to a specific datastore for store the futur backup. In my case, I will use the datastore : <b> datastore-backup </b>

```
ssh -p 22 root@the-ip-of-your-esxi
cd /vmfs/volumes/
ls # your datastore will be apears" 
cd datastore-backup
# your datastore is identify by an inode (datastore-backup) and an id like this : 
# 5e566f71-06f2da78-82d5-441ea15ee924
```

Example of the absolute path, that we will need for the next steps : </br>

<code> /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/ </code> </br>
or <br>
<code> /vmfs/volumes/datastore-backup/</code> <br>

You can use one of them, it's does not matter

### Files to edit

We need to edit .sh / .php files. Let's start with controller.php file. (Location : Root of the project)
```
nano /var/www/html/ESXi-Web-Management-Tool
```

```
$PORT=22; // TO CHANGE 
$HOST="10.69.255.41"; // TO CHANGE, ESXi IP
$CHECKBACKUPFOLDER="ls -dt /vmfs/volumes/datastore-backup/*"; // TO CHANGE !
$LOG="/vmfs/volumes/datastore-backup/logbackup.txt"; 
// TO CHANGE, the file will be created automaticaly later
```

save the changes, and go to the sub folder scripts. 

```
cd /var/www/html/ESXi-Web-Management-Tool/scripts
```

Patience, two more edit, and we can start to access to the project trought the WEB. :) 

``` 
nano BackupSingleVM.sh
```
```
PATHLOG="/vmfs/volumes/datastore-backup/logbackup.txt" # TO CHANGE
mkdir /vmfs/volumes/datastore-backup/backup-vm-$date # TO CHANGE --- Change just the name of the datastore
PATHBACKUP="/vmfs/volumes/datastore-backup/backup-vm-$date" # TO CHANGE --- Change just the name of the datastore 
echo -e "`ls -dt /vmfs/volumes/datastore-backup/backup*`\n" >> $PATHLOG 
find /vmfs/volumes/datastore-backup/backup* -mtime +30 -exec rm -rf {} \; # permit to delete all backup* folders > 30 Days
```
```
nano PoolVMBackup.sh
```
```
PATHLOG="/vmfs/volumes/datastore-backup/logbackup.txt" # TO CHANGE --- Change just the name of the datastore
mkdir /vmfs/volumes/datastore-backup/backup-vm-$date # TO CHANGE --- Change just the name of the datastore
PATHBACKUP="/vmfs/volumes/datastore-backup/backup-vm-$date" # TO CHANGE --- Change just the name of the datastore 
echo -e "`ls -dt /vmfs/volumes/datastore-backup/backup*`\n" >> $PATHLOG 
find /vmfs/volumes/datastore-backup/backup* -mtime +30 -exec rm -rf {} \; # To CHANGE --- Change just the name of the datastore 
# Permit to delete all backup* folders > 30 Days
```
:warning: Warning : Your VMs can be stored in any datastores of your ESXI, but they need to be at the root of the datastore like <code> /vmfs/volumes/mydatastore/MyVirtualMachineDebian </code> <br>

if it's not the case, change the value of the variable <code>"cutedpath=" </code>in the function backupVM(), you will need to edit this variable 4 times, two times in each files.  BackupSingleVM.sh / PoolVMBackup.sh


#### That's it for the configuration of EWMT :white_check_mark:

## Access to the web Pannel

go to http://ip/ESXi-Web-Management-Tool/ (the loading take ~ 7/8 secs)

<img src="https://i.imgur.com/H3u7cAb.jpg">
<i> this is le welcome page of EWMT. </i>
<img src="https://i.imgur.com/oFNUZ3e.jpg">
<i> Example of the shutdown section (For poweroff all the VMs of your ESXi). </i>
<img src="https://i.imgur.com/AQauBMu.jpg">
<i> Example of the shutdown section (For poweroff all the VMs of your ESXi). </i>
<i> Example of the shutdown section (For poweroff all the VMs of your ESXi). </i>

## :point_right: Features & tools 

the description is coming soon !

## :question: :speech_balloon:Issues 

1 -  EWMT is available only for debian family. 


### Errors Code 

If you detect an error in the program please open an github issue,
Coming soon !

#### <center>Brlndtech &copy; 2020</center>

