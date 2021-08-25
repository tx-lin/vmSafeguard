# vmSafeguard - Docker install 

<em> This little guid will show you how to setup vmSafeguard app as a docker container (not for a production environnement) </em> <b>
<strong> Some feature are not available fore the moment like backup scheduling </strong>

youtube video (same content as bellow): https://youtu.be/UtxZ28hAzQ4

<strong> I suppose that you have read the root readme (until installation part) </strong>

## I. Pull (run) vmSafeguard's image from docker hub 

### For current ESXi version 7.X 

As root, execute the following commands : 

```
docker run -d -p 8080:80 archidote/vmsafeguard
# docker run -d -p 8080:443 archidote/vmsafeguard if you want to use https protocol
docker ps 
docker exec -it <id of the container vmSafeguard> bash
-----------------
# You are into the container with a bash shell
# Disable the ESXi firewall  to allow API req to an pother port than 80 (if use 8080 like above, from your docker host)
esxcli network firewall set --enabled false
cd /root/.ssh/
```
<img src="https://i.imgur.com/X9tX4RW.png"> <br> <br>

### For old ESXi version 6.x 

```
docker run -d -p 8080:80 archidote/vmsafeguard:6.x
# docker run -d -p 8080:443 archidote/vmsafeguard if you want to use https protocol
docker ps 
docker exec -it <id of the container vmSafeguard> bash
-----------------
You are into the container with a bash shell
cd /root/.ssh/
```

## II. Copy your ssh public key to your ESXi(s)

```
cat id_rsa.pub | ssh -p 22 root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
<enter the password of esxi user (root) (just one time)>
exit
ssh -p 22 root@the-ip-of-your-esxi # try to connect to the esxi trought ssh (now, you don't need to provide a password)
exit
-----------------
```
<img src="https://i.imgur.com/HmYfC8T.png"> <br> <br>


## III. Edit your datastore name (the one who will store the future backups)

```
cd /var/www/html/vmSafeguard/scripts
nano /var/www/html/vmSafeguard/scripts/backup.sh
```

<img src="https://i.imgur.com/UeGaZMs.png">

Save backup.sh file and exit from the container. 

```
exit # From the vmSafeguard container terminal 
```

## IV. Setup the webpannel 

With a browser that can communicate with your docker host and (ESXi(s)) enter the following url for setuping your first connexion : 

http(s)://localhost:8080/vmSafeguard/scripts/starter.php

When you access to vmSafeguard, you need to provide an id and a password : 

Default credentials : 

- ID : admin
- Password : helloworld

Feel free to change them ASAP via the settings menu.

<img src="https://i.imgur.com/4VUeJar.png"> <br> 

Backup folder : /vmfs/volumes/datastore-backup/
- place that will welcome the futur backup 

Logs Path : /vmfs/volumes/datastore-backup/logsbackup.txt
- vmSafeguard logs are stored on the datastore.

Return to the root README, if you want to continue to discover vmSafeguard app ! ( <a href="https://github.com/archidote/vmSafeguard/#anchor-vmsafeguards-dashboard"> section vmSafeguard's Dashboard </a>


