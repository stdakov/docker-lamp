# docker-lamp

A ready to use docker-compose configuration with php, mysql, phpmyadmin, redis, redis-commander, apache2.

Containers:

- PHP 7.4
- Apache 2.4
- MySQL 5.7 or MariaDB 10.3
- phpMyAdmin
- Redis
- Redis Commander

## Installation

```shell
git clone https://github.com/stdakov/docker-lamp.git
cd docker-lamp/
git pull
cp sample.env .env
docker-compose up -d
```

Wait some minutes and the containers are ready to go.

To confirm that everything is running fine go to `http://localhost`.

#### Update container configuration

If you want to change some container configuration you need to rebuild the container:

```shell
docker-compose up -d --no-deps --build {service-name}
```

```shell
docker-compose up -d --no-deps --build phpmyadmin
```
```shell
docker-compose up --build -d
```
#### Connect to container:

```shell
docker-compose exec {service-name} bash
```

```shell
docker-compose exec webserver bash
```

#### Restart everything:

```shell
docker-compose restart
```

#### Stop everything:

```shell
docker-compose stop
```

#### Remove everything:

```shell
docker-compose down -v
```

## Configuration Variables (.env)

- **WEBSERVER** (`webserver-7.4.x`) - The name of the php/apache container and the path to currect php container version.
- **WEBSERVER_PORT** (`80`) - If you already has the port 80 in use, you can change it (for example if you have Apache)
- **WEBSERVER_PORT_SSL** (`443`) - If you already has the port 443 in use, you can change it (for example if you have Apache)
- **DOCUMENT_ROOT** (`./www`) - It is a document root for Apache server. All your sites will go here and will be synced automatically.
- **VHOSTS_DIR** (`./config/vhosts`) - You can place your virtual hosts conf files here. Make sure you add an entry to your system's `hosts` file for each virtual host.
- **APACHE_LOG_DIR** (`./logs/apache2`) - Apache logs.
- **PHP_INI** (`./config/php/php.ini`) - PHP configuration.
- **DATABASE** (`mysql`) - If you want to use mariadb instead of `mysql` use `mariadb`
- **MYSQL_DATA_DIR** (`./data/mysql`) - All your MySQL/MariaDB data files will be stored here.
- **MYSQL_LOG_DIR**(`./logs/mysql`) - This will be used to store MySQL/MariaDB logs.
- **MYSQL_PORT**(`3306`) - If you already has the port 3306 in use, you can change it (for example if you have MySQL)
- **MYSQL_ROOT_PASSWORD** (`password`) - MySQL root password.
- **MYSQL_USER** (`docker`) - Default MySQL user
- **MYSQL_PASSWORD** (`docker`) - Default MySQL user password
- **MYSQL_DATABASE** (`docker`) - Default MySQL database
- **PHPMYADMIN_PHP_INI** (`./config/phpmyadmin/phpmyadmin-misc.ini`) -
- **REDIS_PORT** (`6379`) - Redis port. If you already use that port, you can change it.

#### Apache, PHP Modules

By default following modules are enabled.

- rewrite
- headers
- ssl
- remoteip


#### Extensions

By default following extensions are installed.

- mysqli
- mbstring
- zip
- intl
- mcrypt
- curl
- json
- iconv
- xml
- xmlrpc
- gd
- locales
- ffmpeg
- unzip
- php-exif

#### Using composer

To use composer login on the container using ssh:

```shell
docker-compose exec webserver bash
cd {project-folder}
composer update
```

> If you want to enable more modules, just update `./bin/webserver-7.3.x/Dockerfile`.
> You have to rebuild the docker image by running `docker-compose build` and restart the docker containers.

## phpMyAdmin

- http://localhost:8080/
- username: `root`
- password: `password`

## Redis

It comes with Redis. It runs on default port `6379`.

## Redis Commander

- http://localhost:8082/
