<?php
session_start();

require_once __DIR__ . '/../../database/koneksi.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

$user_id = $_SESSION['id'];

// Cek apakah form dikirim
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
    exit;
}

// Ambil data
$id_cp              = (int) $_POST['id_cp'];
$nama_barang        = mysqli_real_escape_string($conn, trim($_POST['nama_barang']));
$lokasi             = mysqli_real_escape_string($conn, trim($_POST['lokasi']));
$jenis_barang       = mysqli_real_escape_string($conn, trim($_POST['jenis_barang']));
$metode_pembayaran  = mysqli_real_escape_string($conn, trim($_POST['metode_pembayaran']));
$catatan            = mysqli_real_escape_string($conn, trim($_POST['catatan']));

// Update data
mysqli_query($conn, "
    UPDATE catatan_pengeluaran
    SET
        nama_barang = '$nama_barang',
        lokasi = '$lokasi',
        jenis_barang = '$jenis_barang',
        metode_pembayaran = '$metode_pembayaran',
        catatan = '$catatan'
    WHERE
        id_cp = '$id_cp'
    AND
        user_id = '$user_id'
");

// Kembali ke halaman lihat catatan
header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
exit;
