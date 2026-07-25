# 💰 OGIKFINANC

> Sistem Informasi Pengelolaan Anggaran Pengeluaran Pribadi Berbasis Web menggunakan PHP Native, Bootstrap 5, dan MySQL.

![PHP](https://img.shields.io/badge/PHP-Native-777BB4?logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=white)
![Chart.js](https://img.shields.io/badge/Chart.js-F5788D?logo=chartdotjs&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green)

---

## 📖 Deskripsi

OGIKFINANC merupakan aplikasi berbasis web yang dirancang untuk membantu pengguna dalam mengelola anggaran pengeluaran pribadi.

Pengguna dapat menentukan dana awal sebagai anggaran, kemudian mencatat setiap transaksi pengeluaran. Setiap transaksi yang disimpan akan secara otomatis mengurangi saldo dana yang tersedia sehingga pengguna dapat memantau kondisi keuangan secara lebih mudah.

Selain pencatatan pengeluaran, aplikasi ini juga menyediakan grafik pengeluaran bulanan, catatan pribadi (Notes), kalkulator, pencadangan database, dan ekspor data ke Microsoft Excel.

---

## ✨ Fitur

- 🔐 Login & Register
- 📊 Dashboard
- 📉 Grafik Pengeluaran Bulanan
- 📝 Catat Pengeluaran
- 📝 Catat pemasukan
- 📋 Histori Pengeluaran
- 📋 Histori Pemasukan
- 📝 Notes
- 🧮 Kalkulator
- 💾 Backup Database
- 📄 Export Histori ke Microsoft Excel

---

## 🚀 Cara Kerja Sistem

1. Pengguna melakukan Login atau Register.
2. Menambahkan Dana Awal sebagai anggaran yang akan digunakan.
3. Mencatat setiap transaksi pengeluaran.
4. Sistem akan mengurangi saldo dana secara otomatis berdasarkan nominal pengeluaran.
5. Seluruh transaksi tersimpan ke database dan dapat dilihat pada halaman Histori Pengeluaran.
6. Dashboard menampilkan informasi dana saat ini dan grafik pengeluaran bulanan.
7. Pengguna dapat melakukan backup database maupun meng-export histori transaksi ke Microsoft Excel.

---

## 🛠️ Teknologi yang Digunakan

### Frontend

- HTML5
- CSS3
- Bootstrap 5
- JavaScript

### Backend

- PHP Native

### Database

- MySQL
- phpMyAdmin

### Library

- Chart.js
- Bootstrap Icons

### Tools

- Visual Studio Code
- XAMPP (Apache)
- Google Chrome

---

## 📂 Struktur Folder

```
OGIKFINANC/
│
├── assets/
│
├── css/
├── img/
├── js/
│
├── proses/
├── vendor/
├── database/
│
├── login.php
├── register.php
├── logout.php
├── user.php
├── README.md
└── LICENSE
```

---

## 📸 Tampilan Aplikasi

### 🔐 Login

> `screenshots/login.png`

---

### 📊 Dashboard

> `screenshots/dashboard.png`

---

### 💰 Catat Pengeluaran

> `screenshots/catat-pengeluaran.png`

---

### 📋 Histori Pengeluaran

> `screenshots/lihat-catatan.png`

---

### 📝 Notes

> `screenshots/notes.png`

---

### ⚙️ Fitur Lainnya

> `screenshots/fitur-lainnya.png`

---

## ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/OGIKFINANC.git
```

### 2. Pindahkan Project

```
htdocs/
```

### 3. Jalankan

- Apache
- MySQL

menggunakan XAMPP.

### 4. Import Database

Import file database yang berada pada folder

```
database/
```

menggunakan phpMyAdmin.

### 5. Jalankan Project

```
http://localhost/OGIKFINANC
```

---

## 📊 Fitur Dashboard

Dashboard menampilkan:

- Saldo Dana Saat Ini
- Grafik Pengeluaran Bulanan
- Informasi Pengeluaran

---

## 💾 Export & Backup

Aplikasi menyediakan fitur:

- Export histori pengeluaran ke Microsoft Excel.
- Backup database MySQL untuk menjaga keamanan data.

---

## 👨‍💻 Developer

**Yogi Irawan**

Mahasiswa Informatika

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran, pengembangan kemampuan pemrograman web, dan portofolio pribadi.

MIT License.
