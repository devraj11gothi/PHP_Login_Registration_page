FROM php:8.2-apache
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true && \
    a2enmod mpm_prefork rewrite && \
    docker-php-ext-install mysqli pdo pdo_mysql
COPY . /var/www/html/
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf
CMD ["sh", "-c", "PORT=${PORT:-80} apache2-foreground"]
