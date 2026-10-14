<?php
// Ambil kredensial dari Vercel (Environment Variables). Jika tidak ada, otomatis pakai lokal XAMPP
$host     = getenv('DB_HOST') ?: 'localhost';
$port     = getenv('DB_PORT') ?: 3306;
$user     = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASSWORD') ?: '';
$database = getenv('DB_NAME') ?: 'ogikfinanc';

// Inisialisasi mysqli
$conn = mysqli_init();

// Jika berjalan di Vercel (online), aktifkan SSL karena TiDB Cloud wajib SSL
if (getenv('DB_HOST')) {
    mysqli_ssl_set($conn, NULL, NULL, NULL, NULL, NULL);
}

// Membuat koneksi
$success = mysqli_real_connect($conn, $host, $user, $password, $database, $port, NULL, MYSQLI_CLIENT_SSL);

// Cek koneksi
if (!$success) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengatur charset agar mendukung UTF-8
mysqli_set_charset($conn, "utf8mb4");
