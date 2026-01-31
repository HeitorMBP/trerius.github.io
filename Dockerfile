FROM php:8.2-cli

RUN apt-get update && apt-get install -y libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli

WORKDIR /app
COPY . .

CMD php -S 0.0.0.0:$PORT -t .
