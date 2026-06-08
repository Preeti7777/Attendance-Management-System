FROM php:8.2-apache

# Install mysqli and pdo extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli

# Copy project files to Apache's web root
COPY . /var/www/html/

# Enable mod_rewrite
RUN a2enmod rewrite

# Allow .htaccess overrides
RUN echo '<Directory /var/www/html/>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/custom.conf \
&& a2enconf custom.conf

EXPOSE 80