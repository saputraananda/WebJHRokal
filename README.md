HEAD
# 🚀 Website Roti Kalkun

Website **Roti Kalkun** adalah sistem manajemen transaksi berbasis web yang digunakan oleh **Admin** dan **Supervisor** untuk mengelola transaksi penjualan, retur, dan setor. Website ini dibangun menggunakan **Laravel 11**, dengan sistem autentikasi berbasis session dan middleware untuk membatasi akses berdasarkan role pengguna.

---

## 🎯 **Fitur Utama**
1️⃣ **Sistem Login**
   - User harus login sebelum mengakses sistem.
   - Menggunakan `username` dan `password` yang tersimpan di database.
   - Role user ditentukan saat login (Admin atau Supervisor).

2️⃣ **Role-Based Access**
   - **Admin:** Bisa mengelola transaksi sepenuhnya (CRUD).
   - **Supervisor:** Hanya bisa melihat data transaksi tanpa bisa mengedit atau menghapus.

3️⃣ **Manajemen Transaksi**
   - **Admin:** Dapat menambahkan, mengedit, dan menghapus transaksi.
   - **Supervisor:** Hanya dapat melihat data transaksi.

4️⃣ **Keamanan**
   - Logout menghapus sesi dan mencegah akses kembali menggunakan tombol "Back".
   - Middleware `auth` dan `role` memastikan hanya user yang sesuai yang bisa mengakses halaman tertentu.
   - Middleware `NoCache` mencegah halaman tersimpan di cache browser setelah logout.

5️⃣ **Prediksi Penjualan**
   - Admin dan Supervisor dapat melihat prediksi penjualan untuk membantu dalam perencanaan bisnis.

---

## 📌 **Teknologi yang Digunakan**
- **Laravel 11** - Framework utama backend
- **Blade Templating** - Untuk tampilan frontend
- **MySQL** - Database untuk menyimpan user dan transaksi
- **Bootstrap** - Untuk styling tampilan
- **Middleware Laravel** - Untuk keamanan dan akses role-based

---

## ⚙️ **Cara Menjalankan Proyek**
### **1️⃣ Clone Repository**
```sh
git clone https://github.com/username/website-roti-kalkun.git
cd website-roti-kalkun
```

### **2️⃣ Install Dependensi**
```sh
composer install
```

---

### **2️⃣ Install Dependensi**
```sh
composer install
```

---

### **3️⃣ Konfigurasi .env**
Copy file .env.example menjadi .env dan ubah konfigurasi database sesuai kebutuhan.
```sh
cp .env.example .env
```
Edit file .env untuk mengatur koneksi database:
```sh
DB_CONNECTION=
DB_HOST=
DB_PORT=
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=
```

### **4️⃣ Jalankan Migrasi & Seeder**
```sh
php artisan migrate
php artisan db:seed --class=UserSeeder
```

---

### **5️⃣ Jalankan Website**
```sh
php artisan serve
```





<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
1f65b27 (First Commit)
