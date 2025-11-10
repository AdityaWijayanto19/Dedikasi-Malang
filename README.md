# 🏛️ Dedikasi Malang

[![PHP Versi](https://img.shields.io/badge/PHP-v8.2+-8.4-777BB4.svg?style=flat-square)](https://www.php.net/)
[![Framework](https://img.shields.io/badge/Laravel-v12-FF2D20.svg?style=flat-square)](https://laravel.com/)
[![Lisensi](https://img.shields.io/badge/Lisensi-MIT-yellow.svg?style=flat-square)](LICENSE)

Sebuah platform informasi dan layanan digital yang didedikasikan untuk Organisasi Pengabdian yang ada di Malang. Proyek ini dibangun menggunakan **Laravel 12** sebagai *backend framework* dan Blade untuk antarmuka pengguna.

## ✨ Fitur Utama

* **[Sebutkan Fitur 1]:** Contoh: Manajemen Kegiatan & Artikel Terkini tentang Dedikasi Malang.
* **[Sebutkan Fitur 2]:** Contoh: CMS Dashboard Admin yang interaktif dan responsive.
* **Sistem Otentikasi:** Menggunakan Laravel Fortify untuk *Login* dan *Register* Admin.

## ⬇️ Instalasi dan Persiapan Proyek

### Prasyarat

Pastikan sistem Anda telah menginstal prasyarat berikut:

* **PHP:** Versi 8.2 atau lebih tinggi (Sesuai kebutuhan Laravel 12).
* **Composer:** Manajer dependensi PHP.
* **Node.js & NPM:** Untuk mengkompilasi aset *frontend* (CSS/JS) dengan **Vite**.
* **Database:** MySQL.

### Langkah-Langkah

1.  **Kloning Repositori:**
    ```bash
    git clone [https://github.com/AdityaWijayanto19/Dedikasi-Malang.git)
    cd dedikasi-malang
    ```

2.  **Instal Dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Konfigurasi Environment:**
    Salin file `.env.example` menjadi `.env` dan atur kunci aplikasi:
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Konfigurasi Database:**
    Edit file `.env` dan masukkan detail koneksi database Anda (DB\_DATABASE, DB\_USERNAME, DB\_PASSWORD).

5.  **Migrasi Database dan Seeding (Opsional):**
    Jalankan migrasi database dan *seeder* untuk mengisi data awal.
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Instal dan Kompilasi Aset Frontend (CSS/JS):**
    ```bash
    npm install
    npm run dev  # Untuk mode development (Hot Reload)
    # atau
    # npm run build # Untuk kompilasi aset production
    ```

## ⚙️ Menjalankan Aplikasi

Jalankan server pengembangan Laravel menggunakan Artisan:

```bash
php artisan serve