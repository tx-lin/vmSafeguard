FROM ubuntu
ENTRYPOINT /usr/sbin/apache2ctl -D FOREGROUND
RUN apt update
RUN DEBIAN_FRONTEND="noninteractive" apt-get -y install tzdata
RUN apt-get install -y -q git curl sudo systemd libpam-systemd cron
RUN curl -sL https://raw.githubusercontent.com/brlndtech/vmSafeguard/master/setup.sh | bash -s docker
RUN ssh-keygen -q -t rsa -N '' -f ~/.ssh/id_rsa

