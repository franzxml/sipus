FROM php:8.1-apache

# Install extension mysqli dan pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk .htaccess
RUN a2enmod rewrite

# Copy project ke /var/www/html
COPY . /var/www/html/

WORKDIR /var/www/html

# Port default Hugging Face adalah 7860, jadi arahkan Apache ke port ini
EXPOSE 7860

CMD ["apache2-foreground"]