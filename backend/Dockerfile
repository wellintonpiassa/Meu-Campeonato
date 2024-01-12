FROM php:8.1-fpm

# Copiando composer.lock e composer.json
COPY composer.lock composer.json /var/www/

# Definidindo diretorio de trabalho
WORKDIR /var/www

# Instalando dependencias
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev \
    libgd-dev \
    libpq-dev

# Limpando cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalando extensões
RUN docker-php-ext-install mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-external-gd
RUN docker-php-ext-install gd
RUN docker-php-ext-install pdo pdo_pgsql

# Instalando composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Adicionando usuarios
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copiando diretório do projeto para o docker
COPY . /var/www

# Copiando permissões
COPY --chown=www:www . /var/www

# Alterando usuario para www
USER www

# Expondo porta 9000 e executando php-fpm no terminal
EXPOSE 9000
CMD php-fpm