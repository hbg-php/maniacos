# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    ca-certificates \
    curl \
    git \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libzip-dev \
    libbz2-dev \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    default-libmysqlclient-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libwebp-dev \
    zip \
    unzip \
    && apt-get clean

# Configurar e instalar extensões PHP
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-configure intl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install -j$(nproc) \
        gd \
        pdo \
        pdo_pgsql \
        pgsql \
        zip \
        intl

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar o Apache
RUN a2enmod rewrite
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código do Laravel para o container
COPY ./laravel/maniacos /var/www/html

# Copiar o arquivo composer.json e composer.lock para o container
COPY ./laravel/maniacos/composer.json /var/www/html/

# Definir permissões para o diretório principal
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 757 /var/www/html

# Configurar permissões para o diretório de storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

RUN composer install --no-dev --optimize-autoloader

# Instalar Node.js e NPM
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Expor a porta 80 do Apache
EXPOSE 80

# Executar o Apache no start do container
CMD ["apache2-foreground"]