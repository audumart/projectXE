#!/bin/bash

#installing updates manager
apt-get update -y

#installing nginx
apt-get install nginx -y
rm /etc/nginx/sites-available/default
cp /vagrant/default /etc/nginx/sites-available

#setting up php
add-apt-repository ppa:ondrej/php -y
apt-get install -y python-software-properties build-essential
apt-get update -y
apt-get install php7.0 php7.0-fpm php7.0-mysql php7.0-mcrypt php7.0-curl php7.0-mbstring -y 
rm /etc/php/7.0/fpm/pool.d/www.conf
cp /vagrant/www.conf /etc/php/7.0/fpm/pool.d

#installing mysql server
apt-get install debconf-utils -y 
debconf-set-selections <<< "mysql-server mysql-server/root_password password root"
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password root"
apt-get install mysql-server -y

#installing phpmyadmin
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password root"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password root"
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password root"
debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect none"
apt-get install phpmyadmin -y

#linking phpmyadmin to vagrant
phpenmod mcrypt 
phpenmod mbstring 
ln -s /usr/share/phpmyadmin /vagrant/www

#restarting nginx and php
service nginx restart
service php7.0-fpm restart