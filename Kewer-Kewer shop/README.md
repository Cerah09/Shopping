website toko online

## Fitur

-   Katalog Produk
-   Keranjang Belanja
-   Proses Checkout
-   Pencarian Produk
-   Panel Admin
-   Sistem Autentikasi

## Teknologi yang Digunakan

-   PHP
-   MySQL
-   HTML/CSS/JavaScript
-   Bootstrap (untuk tampilan responsif)

## Persyaratan Sistem

-   PHP 8.3+
-   MySQL 8.3+
-   Web server (Apache/Nginx)
Konfigurasi `config.php`:

    ```php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'username');
    define('DB_PASS', 'password');
    define('DB_NAME', 'Kewer-Kewer shop');
    ```
## Struktur Direktori

```
Kewer-Kewer shop/
├── admin/
├── assets/
├── includes/
├── products/
├── user/
├── config.php
├── functions.php
└── index.php
```

## Penggunaan

-   Halaman utama: browsing dan pembelian
-   Panel admin: `/admin`
-   Akun default admin:
    -   Username: admin
    -   Password: password