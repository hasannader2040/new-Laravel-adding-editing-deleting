FROM composer:latest

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

USER laravel

WORKDIR /var/www/html

ENTRYPOINT [ "composer", "--ignore-platform-reqs" ]



version: "3.9"

networks:
  laravel_enviroment:

services:
  server:
    build:
      context: .
      dockerfile: dockerfiles/nginx.dockerfile
    ports:
      - 8080:80
    volumes:
      - ./src:/var/www/html
      - ./nginx/default.conf:/etc/nginx/conf.d/default.conf:ro
    depends_on:
      - php
      - redis
      - mysql
      - mailhog
    container_name: laravel_enviroment_server
    networks:
      - laravel_enviroment
  php:
    build:
      context: .
      dockerfile: dockerfiles/php.dockerfile
    volumes:
      - ./src:/var/www/html:delegated
    container_name: php_laravel_enviroment
    networks:
      - laravel_enviroment
  mysql:
    image: mysql:8.0.1
    restart: unless-stopped
    tty: true
    container_name: mysql_laravel_enviroment
    env_file:
      - mysql/.env
    ports:
      - 3306:3306
    networks:
      - laravel_enviroment
    volumes:
      - /opt/mysql_data:/var/lib/mysql
  phpmyadmin:
    image: phpmyadmin/phpmyadmin:latest
    restart: always
    container_name: phpmyadmin_laravel_enviroment
    depends_on:
      - mysql
    ports:
      - '8891:80'
    environment:
      - PMA_HOST=mysql
      - PMA_USER=root
      - PMA_PASSWORD=secret
    networks:
      - laravel_enviroment
  redis:
    image: redis:alpine
    container_name: redis_laravel_enviroment
    restart: unless-stopped
    ports:
      - 6379:6379
    networks:
      - laravel_enviroment
    command: redis-server --appendonly yes --replica-read-only no

  composer:
    build:
      context: ./dockerfiles
      dockerfile: composer.dockerfile
    volumes:
      - ./src:/var/www/html
    depends_on:
      - php
    networks:
      - laravel_enviroment
  artisan:
    build:
      context: .
      dockerfile: dockerfiles/php.dockerfile
    volumes:
      - ./src:/var/www/html
    entrypoint: ["php", "/var/www/html/artisan"]
      #depends_on:
    #- mysql
    networks:
      - laravel_enviroment
  scheduler:
    build:
      context: .
      dockerfile: dockerfiles/php.dockerfile
    container_name: scheduler_laravel_enviroment
    volumes:
      - ./src:/var/www/html
    working_dir: /var/www/html
    entrypoint: [ "php", "artisan", "schedule:work" ]
    networks:
      - laravel_enviroment
  mailhog:
    image: mailhog/mailhog:latest
    container_name: mailhog_laravel_enviroment
    ports:
      - 1025:1025
      - 8025:8025
    networks:
      - laravel_enviroment
