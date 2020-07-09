# ESXi Web Management Tool -  Project 
EWMT project has been create to 
facilitate the management of an ESXi espially for Group (VMs) actions and group vm backuping 

## :bookmark_tabs: Prerequisite

- EWMT can be installed under "Debian Family". For the  devloppment of this project, I currently use Ubuntu 20.04
- ESXi(s) Server operational and available trought your local network :) 

## :pushpin: Easyest Installation 1/2

### Easiest Way - Run setup.sh with curl 
<i> EWMT need some dependencies to work, You need to install of them before setuping EWMT. </i>

```
curl -sL https://raw.githubusercontent.com/brlndtech/Beta-ESXi-Management-Tool/master/setup.sh | sh
``` 

## :pushpin: Easyest Installation 2/2
```
sudo apt install git apache2 php htop wget
sudo git clone https://github.com/brlndtech/ESXi-Web-Management-Tool
sudo mv ESXi-Web-Management-Tool /var/www/html
sudo chmod 700 -R /var/www/html/ESXi-Web-Management-Tool
sudo chown -R www-data:www-data /var/www/html/ESXi-Web-Management-Tool
sudo echo 'www-data ALL = (ALL) NOPASSWD: ALL' >> /etc/sudoers.d/myOverrides
```

**WARNING** : You need to be <b>root</b> or have sudo rights for executing these commands. 

## Configuration
#

Once you have finished the installation process, you will need to do some stuff before edit some files of the project (previous to access to the EWMT trought http). 

### On your Server (Who host EWMT) : 

#### Create your ssh-key pair 

```
ssh-keygen -t rsa 
```

#### Upluad your public key to the ESXi server

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
ls "your datastore will be apears" 
cd datastore-backup
# your datastore identify by a inode (datastore-backup) or an id like this : 
# 5e566f71-06f2da78-82d5-441ea15ee924
```

Example of the absolute path, that we will need for the next steps : </br>

<code> /vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/ </code>
<code> /vmfs/volumes/datastore-backup/ (inode link of 5e566..) </code>

```
$PORT=22; // TO CHANGE 
$HOST="10.69.255.41"; // TO CHANGE
$CHACKBACKUPFOLDER="ls -dt /vmfs/volumes//backup*"; // TO CHANGE !
$LOG="/vmfs/volumes/5e566f71-06f2da78-82d5-441ea15ee924/scripts/logbackup.txt"; // TO CHANGE
```

## :point_right: Features & tools 

the description is coming soon !

## :question: :speech_balloon:Issues 

1 -  EWMT is available only for debian family. **Readhat family is not fully compatible.** 


### Errors Code 

If you detect an error in the program please open an github issue,
Coming soon !

#### <center>Brlndtech &copy; 2019-2020</center>

