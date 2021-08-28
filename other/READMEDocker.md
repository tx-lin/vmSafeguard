# vmSafeguard - Docker install 

<em> This little guid will show you how to setup vmSafeguard app as a docker container (not for a production environnement) </em> <br>
<strong> Some feature are not available fore the moment like backup scheduling </strong>

<strong> I suppose that you have read the root readme (until installation part) </strong>

To make things simpler, I will simply use the HTTP protocol with port 80 of the container which will be linked to port 8080 of the dockeR host.

## I. Pull (run) vmSafeguard's image from docker hub 

### For current ESXi version 7.X 

As root, execute the following commands : 

```
docker run -d -p 8080:80 archidote/vmsafeguard
docker ps 
docker exec -it <id of the container vmSafeguard> bash
-----------------
# You are into the container with a bash shell
# !!! Start cron service : 
service cron start
cd /root/.ssh/
```
<img src="https://i.imgur.com/X9tX4RW.png"> <br> <br>

### For old ESXi version 6.x 

```
docker run -d -p 8080:80 archidote/vmsafeguard:6.x
docker ps 
docker exec -it <id of the container vmSafeguard> bash
-----------------
*** You are into the container with a bash shell ***
# !!! Start cron service : 
service cron start
cd /root/.ssh/
```

## II. Copy your ssh public key to your ESXi(s) from your vmSafeguard container

```
cat id_rsa.pub | ssh -p 22 root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
<enter the password of esxi user (root) (just one time)>
exit
ssh -p 22 root@the-ip-of-your-esxi # try to connect to the esxi trought ssh (now, you don't need to provide a password)
# OPTIONAL : Disable the ESXi firewall to allow API req to an pother port than 80 (if use 8080 like above, from your docker host)
esxcli network firewall set --enabled false
exit
-----------------
```


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

<a href="https://github.com/archidote/vmSafeguard/#fast_forward-access-to-the-web-panel"> Return to the root README, to configure the web panel. </a> Section :  Access to the web panel


