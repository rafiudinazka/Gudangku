# Gudangku - Sistem Manajemen Gudang 📦

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg)

## 📋 Deskripsi

**Gudangku** adalah aplikasi web sistem manajemen gudang yang dirancang untuk memudahkan pengelolaan inventori barang, tracking keluar masuk barang, dan manajemen supplier. Sistem ini dilengkapi dengan role-based access control untuk Admin dan Petugas.

## ✨ Fitur Utama

### 👨‍💼 Admin
- **Data Admin** - Kelola akun administrator
- **Data Rak** - Manajemen lokasi penyimpanan barang
- **Data Supplier** - Kelola informasi supplier/vendor
- **Data Barang** - Master data produk/barang
- **Data Barang Keluar** - Pencatatan barang yang keluar dari gudang

### 👷 Petugas
- **Data Barang Masuk** - Input barang yang masuk ke gudang
- **Data Ajuan** - Kelola permintaan/ajuan barang

## 🚀 Teknologi yang Digunakan

- **Backend**: PHP (Native/Framework)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **CSS Framework**: Bootstrap
- **Icons**: Font Awesome

## 📌 Persyaratan Sistem

- PHP >= 7.4
- MySQL >= 5.7
- Web Server (Apache/Nginx)
- Web Browser (Chrome, Firefox, Safari, Edge)

## 🛠️ Instalasi

1. **Clone Repository**
   ```bash
   git clone https://github.com/rafiudinazka/Gudangku.git
   cd Gudangku
   ```

2. **Setup Database**
   - Buat database baru di MySQL
   ```sql
   CREATE DATABASE gudangku;
   ```
   - Import file database 
   ```bash
   mysql -u username -p gudangku < database/inventory.sql
   ```

3. **Konfigurasi Koneksi Database**
   - Edit file konfigurasi database
   - Sesuaikan host, username, password, dan nama database

4. **Jalankan Aplikasi**
   - Akses melalui web browser
   ```
   http://localhost/Gudangku 
   ```
   username : admin password : admin         (untuk login admin)
   username : petugas password : petugas     (untuk login petugas)


## 💻 Cara Penggunaan

### Login
1. Buka aplikasi di browser
2. Masukkan username dan password
3. Pilih role (Admin/Petugas)

### Admin
- Dashboard menampilkan statistik inventori
- Kelola semua master data melalui menu yang tersedia
- Monitor laporan barang keluar

### Petugas  
- Input data barang masuk
- Buat ajuan untuk kebutuhan barang keluar
