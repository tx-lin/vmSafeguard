# vmSafeguard - Docker install 

<em> This little guid will show you how to setup vmSafeguard app as a docker container </em>

<strong> I suppose that you have read the root readme (until installation part) </strong>

As root, execute the following command : 

```
docker run -d -p 8080:80 brlndtech/vmSafeguard
# docker run -d -p 8080:443 brlndtech/vmSafeguard if you wan to use https protocol
docker ps 
docker exec -it <id of the container vmSafeguard> bash
-----------------
You are into the container with a bash shell
cd /root/.ssh/
```
<img src="https://i.imgur.com/X9tX4RW.png"> <br> <br>
```
cat id_rsa.pub | ssh -p 22 root@the-ip-of-your-esxi \ 'cat >> /etc/ssh/keys-root/authorized_keys'
<enter the password of esxi user (root) (just one time)>
exit
try to connect to the esxi trought ssh (Normally you not need to provide a password)
exit
exit # you will return to your docker host terminal
-----------------
```
<img src="https://i.imgur.com/HmYfC8T.png"> <br> <br>

With a browser that can communicate with your docker host, enter the following url for setuping your first connexion : 

http(s)://localhost:8080/vmSafeguard/script/starter.php

When you access to vmSafeguard, you need to provide an id and a password : 

Default credential : 

- ID : admin
- Password : helloworld

Feel free to change them ASAP via the settings menu.

<img src="https://i.imgur.com/4VUeJar.png"> <br> 

Backup folder : /vmfs/volumes/datastore-backup/
- place that will welcome the futur backup 

Logs Path : /vmfs/volumes/datastore-backup/logsbackup.txt
- vmSafeguard logs are stored on the datastore.

Return to the root README.md, if you want to continue to discover vmSafeguard app ! (section vmSafeguard's Dashboard)
