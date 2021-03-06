FROM nginx:stable
#General bringing up  to date and prerequisites
RUN apt-get update && apt-get upgrade -y && apt-get install -y wget lsb-release vim certbot python-certbot-nginx cron default-mysql-client && rm -f /etc/localtime && ln -s /usr/share/zoneinfo/Europe/Riga /etc/localtime \
#Add up to date php PPA, and retrieve latest stable php8 with required extensions that are not bundled with it
&& wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
&& echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
&& apt-get update && apt-get install -y \
php8.0-fpm \
php8.0-mbstring \
php8.0-imagick \
php8.0-zip \
php8.0-xml \
php8.0-curl \
php8.0-intl \
php8.0-mysql \
php8.0-gd \
#Add www-data group to nginx user so that php-fpm has access to nginx pool
&& usermod -aG www-data nginx \
# Installing composer and its prerequisites globally
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --2 &&  php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer
COPY php.ini /etc/php/8.0/fpm/php.ini
COPY startup_script.sh ./
RUN chmod a+x startup_script.sh

# Setup backups & cron
RUN mkdir /backups && mkdir /backups/data && touch /backups/backups.log && touch /backups/certbot.log
ADD mysqldump.sh /backups/
RUN chmod a+x /backups/mysqldump.sh

# Setup crontab
RUN (crontab -l ; echo "0 5 * * 5 certbot -q renew >> /backups/certbot.log 2>&1") | crontab \
&& (crontab -l ; echo "0 4 * * * /backups/mysqldump.sh >> /backups/backups.log 2>&1") | crontab

CMD ./startup_script.sh
