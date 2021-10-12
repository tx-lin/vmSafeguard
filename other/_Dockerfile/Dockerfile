FROM ubuntu
ENTRYPOINT /usr/sbin/apache2ctl -D FOREGROUND
RUN apt update
RUN DEBIAN_FRONTEND="noninteractive" apt-get -y install git curl sudo systemd libpam-systemd cron nano
RUN curl -sL https://raw.githubusercontent.com/archidote/vmSafeguard/master/setup.sh | bash
RUN ssh-keygen -q -t rsa -N '' -f ~/.ssh/id_rsa
ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone