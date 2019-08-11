FROM php:7.2-apache

RUN apt-get update
RUN apt-get install zip git -y
RUN docker-php-ext-install pdo pdo_mysql
RUN curl -s https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

# Apache conf
# allow .htaccess with RewriteEngine
RUN a2enmod rewrite

EXPOSE 80 443

WORKDIR /var/www/html

# start Apache2 on image start
CMD ["/usr/sbin/apache2ctl","-DFOREGROUND"]