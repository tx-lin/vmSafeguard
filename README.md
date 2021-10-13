# vmSafeguard -  Project

vmSafeguard project has been created to facilitate the management and the VMs<b> backup </b> of an ESXi. With this tool, you will be able to backup a pool of VMs, Single Vm, Read the Backup logs etc. <u> <b> vmSafeguard can manage multiple ESXi since 5.0 version. </u> </b>

Enjoy :) 

Table of contents
=

Check the readme (auto generate) table of contents, by clicking on the icon underlined in yellow : 

<img src="https://i.imgur.com/r9K4wjp.png">


<br>
<br>

# :bookmark_tabs: Prerequisite !

- vmSafeguard can be installed under "Debian Family". For the  devloppment of this project, I currently use Kali linux 2021.x, Php 7.4, Apache 2.4.X. To avoid unknow errors, I recommand you to use Ubuntu, Debian or Kali linux.

- <strong> <code> curl </code> and <code> sudo </code> command need to be install  ! </strong>
- An ESXi Server operational that can communicate with the machine that will host vmSafeguard (pinguable) 
- SSH service, and ESXi shell need to be activated ! (at the startup)
- Administrator privileges on ESXi and your Linux host

### :heavy_exclamation_mark: Especially not to do
- <strong> Don't add space between each word of a vm name. </strong> (VMs need to have a
nomenclature like this : Debian-10-64Bits or Debian_10_64bits but not like that : Debian 10 64bits, <strong> otherwise vmSafeguard will crash </strong>
- <strong> don't store you VM in a subfolder of a datastore. </strong> (VMs need to be stored at the root of a specific datastore like that : 
<br>
/vmfs/volume/datatsore1/MyDebian10Vm/ :white_check_mark:
<br>
And especially not like that
<br>
/vmfs/volume/datastore1/VMsdebian/MyDebian10Vm/ :x:

# ESXi supported version 

vmSafeguard is currently available for the following ESXi version : 

- 7.0.X (Follow step by step the readme)
- 6.x   (Read the <a href="https://github.com/archidote/vmSafeguard/tree/6.1.1#readme">readme of this branch</a>, to setup vmSafeguard for an ESXi < 7.0)

# :pushpin: Installation (Easyest)

### Easiest Way - Run setup.sh with curl, to automating the installation

**WARNING**: You need to be <b>root</b> or have sudo rights for executing these commands.

Update your server before to start the installation. <code>apt update</code> 

if you used debian, please execute this command as root <code> su - </code>  before to run the next command. :) 

For ESXi version 7.X run this command : 

```
sudo curl -sL https://raw.githubusercontent.com/archidote/vmSafeguard/master/setup.sh | bash
```

For old ESXi version (6.x), please run this command : 

```
sudo curl -sL https://raw.githubusercontent.com/archidote/vmSafeguard/master/setup.sh | bash -s 6.x
```


## Docker install "On the fly" - Do you want to run vmSafeguard as a contaiener with docker ? 

It's now possible ! But I don't recommanded this alternative for a production environnement !

Navigate to <a href="https://github.com/archidote/vmSafeguard/blob/master/other/READMEDocker.md">other/READMEDocker.md </a>, to see a quick tutorial for setup vmSafeguard as a docker container.

**WARNING** : <i>You need to be <b>root</b> or have sudo rights for executing these commands.</i>

# :computer: Configuration 1/2 - On your server (Who host vmSafeguard) : 

Once you have finished the installation process, you will need to do some stuff before to edit few files of the project (previous to access to the vmSafeguard trought the web.

## :key: Create your ssh-key pair as root if you don't already have it 

```
ssh-keygen -t rsa 
```

### :arrow_up: Upluad your public key on the ESXi server
<br>

Since, vmSafeguard 5.0 version, you can managed multiple ESXi. <b> For that, upluad your public key on each ESXi hypervisor. </b>

<i> Remember ! You need to allow ssh on your ESXI, trought the <a href="https://www.tech2tech.fr/vmware-esxi-6-5-activer-lacces-ssh/">Official Web panel of ESXi Vmware</a>. </i>

On vmSafeguard host : 

```
cd /root/.ssh/
cat id_rsa.pub | ssh -p 22 root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
# answer "yes"
# "you are connected to your esxi host"
exit
ssh -p 22 root@the-ip-of-your-esxi
# normally you are not going to provide the password of the target ESXi
```
<b> This step is crutial for the following step. </b>

# :computer: Configuration 2/2 - Specific datastore path 

### :information_source: Location for the backup (Example)

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


You can use any of them, that's okay. But <b> I suggest you use the second method for more visibility </b>

<br>


### :pencil2: Edit the first .sh backup script (scripts/backup.sh) [1/2]
<br>

```
cd /var/www/html/vmSafeguard/scripts
nano backup.sh
```

at the top of the file this line : 
```
#!/bin/sh
# --- Global Variables ---
DATASTORE="datastore-backup" # Your specific datastore for the futur backup 
<...>
```


### :warning: Warning concerning the VMs storage path : 

<br>

As I said previously your VMs can be stored in any datastores of your ESXi, <b> BUT they need to be at the root of the datastore like <code> /vmfs/volumes/datastore-backup/VMDebianFolder </code> <br> </b>

if it's not the case, change the value of the variable <code>"cutedpath=" </code>in the function backupVM() (backup.sh)


#### That's it for the configuration of vmSafeguard :white_check_mark: , you will be able to start vmSafeguard trought the web

<br>

# :fast_forward: Access to the web panel

## Authentification .htaccess / .htpasswd and first connexion

Setup your first connexion : http(s)://vmsafeguard-ip/vmSafeguard/scripts/router.php?action=welcome

When you access to vmSafeguard, you need to provide an id and a password : 

Default credential : 

- ID : admin
- Password : helloworld

Feel free to change them ASAP via the settings menu

If you want to disable the auth process, remove .htaccess / .htpasswd (location : root of the project)

<img src="https://i.imgur.com/7BxqUwv.png">

Backup folder : /vmfs/volumes/datastore-backup/
- place that will welcome the futur backup 

Logs Path : /vmfs/volumes/datastore-backup/logsbackup.txt
- vmSafeguard logs are stored on the datastore.

Fill all the fields and submit. <br><br>
<img src="https://i.imgur.com/TQbzmT5.png">

All the information have been stored into the db, click to "reload the dashboard", to access to the main menu of vmSafeguard.  <br><br><br>

## :anchor: vmSafeguard's Dashboard

<img src="https://i.imgur.com/ZKgljIE.png">
<i> This is the welcome page of vmSafeguard. </i> <br> <br>

### Execute Backup(s) from the Web interface 

 - If you want to perfom a <b> single backup </b>, enter the machine's vmid, and then click to submit. (If your VM is started, the backup proccess will securely shutdown the VM before to continue. (<b><u>if she has vmware tools on it system, otherwise the vmSafeguard will force powered off her. same process for a "pool backup" below</b></u>) - it may take few minutes -)


 <img src="https://i.imgur.com/8t5nyYN.png">

- Same thing for the <b> pool VMs backup </b>, but add each vmid separed with a space and submit the form. (If your VMs are started, the backup proccess will securely shutdown these VMs before to continue. - it may take few minutes - )

<img src="https://imgur.com/KLtX4zn.png">

<br> 
<br>

### Video Tutorials  

Demo for backup a single virtual machine : https://www.youtube.com/watch?v=J-1uHs3L4Go

Demo for backup a pool of virtual machines : https://www.youtube.com/watch?v=4wjztK1N38U

:bookmark_tabs: Note that, if your machine is powered on, the backup folder will take a few moment before it's creation. vmSafeguard shutdown a VM with a safety mode. If the VM install some update, vmSafeguard, will wait until it's finished before to start the copy. (View the logs section for follow the backup process)

# :ferris_wheel: Automating the backup process with a cron task

## With the web panel (Easyest way): 

You can schedule a crontask for create a "Pool Backup", or just for one VM, with the Graphical Interface. Also, if you want in the futur to remove one crontask or all of them, you can use the "inline form" at the top of the screen. 

<img src="https://i.imgur.com/COWvgua.png">


Once you have submited the form, you will see the crontask (If the cron syntax has been respected)

<img src="https://i.imgur.com/gTGALK1.png">

### Remove a crontask (www-data's crontab)

- In case of you want to remove one crontask, enter the id of the task cron and then press "submit". 

<img src="https://i.imgur.com/pNqiGgY.png">


# Other interesting features 

## Shutdown/Suspend/Start/Summary* vms

<i> Example of the shutdown, suspend and start section (Action will be applied to <strong>all the VMs of your ESXi</strong>). </i> <br> <br>

<img src="https://i.imgur.com/xSNOnmI.png">

For exemple, when I press "Shutdown all VM", this is what will be displayed on your browser. 

<img src="https://i.imgur.com/7CTlAjl.png">

<br> <br>
Example of the summary section. Very useful part if you want to know the vmid of a VM(s) and other information like the ip adress, the os type etc.  <br> 

<img src="https://i.imgur.com/GXb8PHK.png">

<br> <br>

##  Settings Menu 

This menu allow you to do a lot of different things like : 
- change your password 
- add an other ESXi to the database 
- convert a thick disk to thin and vice versa 
- etc.

(Maybe in the futur other features will be implemented. If you have any ideas, submit it to me)

<img src="https://i.imgur.com/hyZAhVN.png">

# Revive a VM from a backup 

Following the next steps : 

<styrong> Warning, you can't revive an VM from a ESXi 7 to a 6.7 if the vmx file if your vmx file is upper than the the current esxi support. <strong> // à modifier 

<img src="https://i.imgur.com/gBMcAyv.png">
<img src="https://i.imgur.com/7zLJORP.png">
<img src="https://i.imgur.com/fdFVkch.png">
<img src="https://i.imgur.com/TLmQ0WN.png">
<img src="https://i.imgur.com/1HaCxLe.png">
<img src="https://i.imgur.com/In1Qhmm.png">
<img src="https://i.imgur.com/qaNVjhS.png">

# :question::speech_balloon: Notes / common questions

1 - vmSafeguard is available only for debian based OS family 
2 - web panel logs are stored into the following file : /var/log/vmSafeguard-server.log
3 - Backups process logs are stored into the <b> backup datastore (at it's root)</b> with the following name : logsbackup.txt
## Know Issues 
1 - If the .htaccess / .htpasswd (not crutial for the project) auth does not work, please check the apache2.conf (/etc/apache2) and replace if you did not have the same result as the following picture : 

<img src="https://i.imgur.com/qJnXFUs.png">

2 - Don't add comment into the description of a vm trought the official ESXI web panel (not multiple line, just one line. Otherwise the " number (total) of VMs will be false")

3 - Don't turn off your server who host vmSafeguard :blush: , when a backup is running. Otherwise it will be cancel the ssh connexion between vmSafeguard and the ESXI

4 - If you want to reinstall vmSafeGuard, just git clone the projet into /var/www/html, and put the correct rights and owner to the project folder. 

``` 
chmod 700 -R /var/www/html/vmSafeguard
chown www-data:www-data -R /var/www/html/vmSafeguard
``` 


# Other


If you detect an error in vmSafeguard, please open a github issue.

Releases details : https://github.com/archidote/vmSafeguard/projects/1 (section "version" (english))

#### Archidote

