FROM node:20-alpine AS node-builder

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm ci --silent

COPY vite.config.js ./
COPY resources ./resources

RUN npm run build

FROM php:8.4-fpm AS base

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
  git \
  unzip \
  libzip-dev \
  libpng-dev \
  libjpeg-dev \
  libfreetype6-dev \
  libonig-dev \
  libicu-dev \
  mariadb-client \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
  pdo_mysql \
  mbstring \
  zip \
  exif \
  intl \
  opcache \
  pcntl

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root -u 1000 -d /home/laravel laravel \
  && mkdir -p /home/laravel/.composer \
  && chown -R laravel:laravel /home/laravel

FROM base AS development

RUN apt-get update && apt-get install -y \
  nodejs \
  npm \
  && rm -rf /var/lib/apt/lists/*

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload -o \
  && composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
  && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

USER www-data

EXPOSE 9000

CMD ["php-fpm"]

FROM base AS production

COPY composer.json composer.lock ./

RUN composer install --no-interaction --prefer-dist --no-scripts --no-autoloader --no-dev

COPY . .

COPY --from=node-builder /app/public/build ./public/build

RUN composer dump-autoload -o \
  && composer install --no-interaction --prefer-dist --no-dev

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

RUN mkdir -p /var/www/html/storage/logs \
  && mkdir -p /var/www/html/storage/framework/cache/data \
  && mkdir -p /var/www/html/storage/framework/sessions \
  && mkdir -p /var/www/html/storage/framework/views \
  && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
  && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]
