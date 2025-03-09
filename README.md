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
