# --- STAGE 1: BUILD (Menggunakan PHP FPM yang lebih stabil) ---
# Menggunakan PHP 8.2-fpm sebagai base image yang stabil
FROM php:8.2-fpm AS base

# Instal dependensi sistem dan PHP extensions yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libicu-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

# Instal Composer secara global
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Instal Node.js (untuk building Vite/assets)
# Menggunakan Node.js 18 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Atur direktori kerja
WORKDIR /app

# Salin semua kode aplikasi
COPY . .

# Buat user non-root khusus (lebih aman)
RUN useradd -ms /bin/bash railway

# Ganti ownership file ke user non-root
RUN chown -R railway:railway /app

# Beralih ke user non-root
USER railway

# --- BUILD COMMANDS (Dijalankan hanya sekali saat build) ---

# 1. Install Composer dependencies (untuk production)
RUN composer install --no-dev --optimize-autoloader

# 2. Build frontend (Vite)
RUN npm install && npm run build

# 3. FIX CRITICAL: Bersihkan Cache dan Konfigurasi di tahap BUILD.
# Ini menjamin assets Tailwind terbaru akan dimuat dan mencegah kegagalan DB saat optimize.
RUN php artisan optimize:clear 

# 4. Atur izin storage (Wajib untuk mengatasi Permissions/CRASHED)
RUN chmod -R 777 storage bootstrap/cache public

# --- STAGE 2: RUNTIME (Mengatur Start Command) ---

# Perintah yang dijalankan ketika kontainer mulai
# Hanya lakukan migrasi dan jalankan server.
# Menghindari config:cache yang sering gagal karena masalah network/DB.
CMD php artisan migrate --force && \
    php artisan serve --host=0.0.0.0 --port=${PORT}