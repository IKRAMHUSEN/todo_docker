# ─────────────────────────────────────────────
# Base image: Official PHP 8.2 with FPM
# FPM = FastCGI Process Manager (handles PHP requests from Nginx)
# ─────────────────────────────────────────────
FROM php:8.2-fpm

# ─────────────────────────────────────────────
# Install system packages needed by Laravel
# ─────────────────────────────────────────────
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ─────────────────────────────────────────────
# Install PHP extensions required by Laravel
# pdo_mysql  → connects PHP to MySQL
# mbstring   → handles multi-byte strings
# exif       → reads image metadata
# pcntl      → process control (queues)
# bcmath     → big number arithmetic
# gd         → image processing
# ─────────────────────────────────────────────
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# ─────────────────────────────────────────────
# Install Composer (PHP package manager)
# We copy it from the official composer image
# ─────────────────────────────────────────────
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ─────────────────────────────────────────────
# Set the working directory inside the container
# All future commands run from here
# ─────────────────────────────────────────────
WORKDIR /var/www/html

# ─────────────────────────────────────────────
# Copy project files into the container
# (During dev, volumes override this — but needed for build)
# ─────────────────────────────────────────────
COPY . .

# ─────────────────────────────────────────────
# Set correct file permissions for Laravel
# www-data is the user Nginx/PHP runs as
# ─────────────────────────────────────────────
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage 2>/dev/null || true

# Expose port 9000 (PHP-FPM listens here for Nginx)
EXPOSE 9000

# Start PHP-FPM when container runs
CMD ["php-fpm"]
