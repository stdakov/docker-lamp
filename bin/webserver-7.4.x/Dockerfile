FROM php:7.4-apache

# Surpresses debconf complaints of trying to install apt packages interactively
# https://github.com/moby/moby/issues/4032#issuecomment-192327844
 
ARG DEBIAN_FRONTEND=noninteractive

# Update
RUN apt-get -y update --fix-missing && \
    apt-get upgrade -y && \
    apt-get --no-install-recommends install -y apt-utils && \
    rm -rf /var/lib/apt/lists/*


# Install useful tools and install important libaries
RUN apt-get -y update && \
    apt-get -y --no-install-recommends install nano wget dialog libsqlite3-dev libsqlite3-0 && \
    apt-get -y --no-install-recommends install mariadb-client zlib1g-dev libzip-dev ffmpeg libicu-dev && \
    apt-get -y --no-install-recommends install --fix-missing apt-utils build-essential git curl && \ 
    apt-get -y --no-install-recommends install --fix-missing pkg-config libonig-dev libcurl4 libcurl4-openssl-dev zip unzip openssl && \
    apt-get -y --no-install-recommends install locales && locale-gen C.UTF-8 && update-locale LANG=C.UTF-8 && \
    rm -rf /var/lib/apt/lists/* && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug-2.9.8 && \
    docker-php-ext-enable xdebug

# Install redis
RUN pecl install redis-4.0.1 && \
    docker-php-ext-enable redis

# Other PHP7 Extensions

RUN docker-php-ext-install curl && \
    docker-php-ext-install tokenizer && \
    docker-php-ext-install json && \
    docker-php-ext-install zip && \
    docker-php-ext-install -j$(nproc) intl && \
    docker-php-ext-install mbstring && \
    docker-php-ext-install exif && \
    docker-php-ext-install gettext

RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli
RUN docker-php-ext-install pdo pdo_mysql pdo_sqlite

# Install Freetype 
RUN apt-get -y update && \
    apt-get --no-install-recommends install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
    docker-php-ext-install -j$(nproc) gd

# Enable apache modules
RUN a2enmod rewrite headers ssl remoteip

WORKDIR /var/www

# Give shell to www-data
RUN usermod --shell /bin/bash www-data

#RUN chown -R www-data:www-data /var/www
#RUN chmod 755 /var/www

# Cleanup
RUN apt-get purge --auto-remove -y && \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /root/.composer/cache && \
    docker-php-source delete
