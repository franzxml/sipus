FROM php:8.1-apache

# Install extension yang dibutuhkan
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Aktifkan mod_rewrite untuk .htaccess
RUN a2enmod rewrite

# Tambahkan ServerName agar warning hilang
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Ubah DocumentRoot Apache ke /var/www/html/public
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf /etc/apache2/apache2.conf

# Ubah port agar sesuai Hugging Face (7860)
RUN sed -i 's/80/7860/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Copy project ke /var/www/html
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/public

# Expose port 7860
EXPOSE 7860

# Jalankan Apache di foreground
CMD ["apache2-foreground"]
