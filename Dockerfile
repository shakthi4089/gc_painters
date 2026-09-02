FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libsqlite3-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd

# Enable Apache mod_rewrite for Laravel routing
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the entire Laravel project into the container
COPY . .

# Update Apache DocumentRoot to point to Laravel's public directory
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Fix folder permissions for Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install PHP dependencies (ignoring dev dependencies for production)
RUN composer install --optimize-autoloader --no-dev

# Create the SQLite database file if it doesn't exist and set permissions
RUN touch /var/www/html/database/database.sqlite
RUN chown www-data:www-data /var/www/html/database/database.sqlite
RUN chown www-data:www-data /var/www/html/database

# Run Laravel migrations and seeders so the website has data!
RUN DB_CONNECTION=sqlite php artisan migrate:fresh --seed --force
RUN chown www-data:www-data /var/www/html/database/database.sqlite

# Render dynamically assigns a port, so we need Apache to listen on $PORT instead of 80
RUN sed -i 's/80/${PORT}/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# We use a shell command to run migrations and seed the database every time the container starts, 
# then start apache. This guarantees the tables exist even if the server restarts!
CMD php artisan migrate:fresh --seed --force && apache2-foreground
