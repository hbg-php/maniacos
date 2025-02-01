# Use a imagem oficial do PHP com Apache
FROM php:8.2-apache

# ARG USERGIT
# ARG EMAILGIT

# Instalar dependências necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libpq-dev \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_pgsql

RUN \
    apt-get update && \
    apt-get install libldap2-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configurar o Apache
RUN a2enmod rewrite
COPY ./apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# RUN mkdir .ssh
# RUN git config --global user.name = USERGIT
# RUN git config --global user.email = EMAILGIT
# RUN git config --global --add safe.directory /var/www/html

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código do Laravel para o container
COPY ./laravel/maniacos /var/www/html

# Copiar o arquivo composer.json e composer.lock para o container
COPY ./laravel/maniacos/composer.json /var/www/html/

# Definir permissões para o diretório principal
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 757 /var/www/html

# Executar o composer install para instalar as dependências
#RUN composer install --no-dev --optimize-autoloader

# Configurar permissões para o diretório de storage e cache
#RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Instalar Node.js e NPM
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

#RUN chmod -R 757  /var/www/html/bootstrap/cache
#RUN chmod -R 757 /var/www/html/storage

# Expor a porta 80 do Apache
EXPOSE 80
EXPOSE 5173

# Executar o Apache no start do container
CMD ["apache2-foreground"]
