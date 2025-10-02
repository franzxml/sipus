FROM php:8.1-apache

# Install extension mysqli dan pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk .htaccess
RUN a2enmod rewrite

# Tambahkan ServerName agar warning hilang
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Ubah konfigurasi Apache agar listen di port 7860
RUN sed -i 's/80/7860/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copy project ke /var/www/html
COPY . /var/www/html/

WORKDIR /var/www/html

EXPOSE 7860

CMD ["apache2-foreground"]
