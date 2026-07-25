<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "ogikfinanc";

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mengatur charset agar mendukung UTF-8
mysqli_set_charset($conn, "utf8");
