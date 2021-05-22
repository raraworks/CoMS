FROM nginx:stable
#General bringing up  to date and prerequisites
RUN apt-get update && apt-get upgrade -y && apt-get install -y wget lsb-release vim git && rm -f /etc/localtime && ln -s /usr/share/zoneinfo/Europe/Riga /etc/localtime \
#Add up to date php PPA, and retrieve latest stable php8 with required extensions that are not bundled with it
&& wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg \
&& echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" | tee /etc/apt/sources.list.d/php.list \
&& apt-get update && apt-get install -y \
php7.4-fpm \
php7.4-mbstring \
php7.4-imagick \
php7.4-zip \
php7.4-xml \
php7.4-curl \
php7.4-intl \
php7.4-mysql \
php7.4-xdebug \
php7.4-gd \
#Add www-data group to nginx user so that php-fpm has access to nginx pool
&& usermod -aG www-data nginx \
# Installing composer and its prerequisites globally
&& php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php --2 &&  php -r "unlink('composer-setup.php');" && mv composer.phar /usr/local/bin/composer
COPY php.ini /etc/php/7.4/fpm/php.ini
COPY startup_script.sh ./
RUN chmod a+x startup_script.sh

CMD ./startup_script.sh
