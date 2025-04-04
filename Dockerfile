# Build Stage 1: PHP Base with Composer
FROM php:8.2-fpm AS base

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    supervisor \
    nano \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    procps \
    net-tools \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Verify that php-fpm is installed
RUN if ! which php-fpm; then echo "php-fpm not found"; exit 1; fi

# install node
RUN curl -fsSL https://deb.nodesource.com/setup_22.x | bash - && \
    apt-get install -y nodejs

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy existing application directory
COPY . .

# Copy only Composer files and install dependencies
RUN composer install --prefer-dist --no-dev --no-interaction --optimize-autoloader

# Build Stage 2: Node.js for building frontend assets
FROM base AS node-builder

WORKDIR /var/www

# Copy only the files needed for the front-end build
COPY package.json package-lock.json /var/www/

# Install Node.js dependencies
RUN npm install

# Copy application source code (for Vite to run build)
COPY . .

# Build assets for production using Vite
RUN npm run build

# Build Stage 3: Final image for production
FROM base

# Copy built frontend assets from node-builder stage
COPY --from=node-builder /var/www/public /var/www/public
COPY --from=node-builder /var/www/resources /var/www/resources

# Set file ownership and permissions for Laravel
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www

# Copy entrypoint script
COPY ./Docker/entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

# Copy Supervisor configuration
COPY ./Docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Use the entrypoint script to start services
CMD ["/usr/local/bin/entrypoint.sh"]

# CMD ["php-fpm"]
