FROM php:7.1-fpm
RUN docker-php-ext-install mysqli pdo_mysql && \
    apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y git && \
    apt-get install -y zlib1g-dev libzip-dev
  
RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

COPY --from=composer:2.2.18 /usr/bin/composer /usr/local/bin/composer

ENV NODE_VERSION=16.13.0

RUN apt install -y curl
RUN curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash

ENV NVM_DIR=/root/.nvm

RUN . "$NVM_DIR/nvm.sh" && nvm install ${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm use v${NODE_VERSION}
RUN . "$NVM_DIR/nvm.sh" && nvm alias default v${NODE_VERSION}

ENV PATH="/root/.nvm/versions/node/v${NODE_VERSION}/bin/:${PATH}"

RUN node --version
RUN npm --version