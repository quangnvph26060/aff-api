# Sử dụng PHP-FPM làm base image
FROM php:7.4-fpm

# Cài đặt các dependencies cần thiết
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo_mysql

# Cài đặt Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Đặt thư mục làm việc
WORKDIR /var/www/html

# Copy mã nguồn Laravel vào container
COPY . .

# Cài đặt các dependencies của Laravel thông qua Composer
# RUN composer install --no-interaction --no-plugins --no-scripts

# Thiết lập quyền cho thư mục storage và bootstrap/cache
RUN chmod -R 777 storage bootstrap/cache

# Copy cấu hình Nginx vào container
# COPY docker/nginx/default.conf /etc/nginx/sites-available/default

# Mở cổng cho Nginx
# EXPOSE 80

# CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
CMD ["nginx", "-g", "daemon off;"]
