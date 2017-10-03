# 
# Production environment for php-demo-project
#

FROM php:apache
WORKDIR /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV TERM linux

RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv-keys E1DD270288B4E6030699E45FA1715D88E1DF1F24  \
    && echo 'deb http://ppa.launchpad.net/git-core/ppa/ubuntu trusty main' > /etc/apt/sources.list.d/git.list \
    && apt-get update \
    && apt-get install -y git unzip zip php-pear

EXPOSE 80


COPY apache.conf /etc/apache2/sites-available/000-default.conf
COPY php.ini /usr/local/etc/php/php.ini
COPY app /var/www/html/
RUN ./composer.phar install
