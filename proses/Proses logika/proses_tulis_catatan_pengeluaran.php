<?php
session_start();
require_once __DIR__ . '/../../database/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

$user_id = $_SESSION['id'];

// Ambil data dari form
$tanggal              = $_POST['tanggal'];
$nama_barang          = mysqli_real_escape_string($conn, $_POST['nama_barang']);
$lokasi               = mysqli_real_escape_string($conn, $_POST['lokasi']);
$jenis_barang         = mysqli_real_escape_string($conn, $_POST['jenis_barang']);
$harga                = (float) $_POST['harga'];
$metode_pembayaran    = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
$catatan              = mysqli_real_escape_string($conn, $_POST['catatan']);

// Ambil dana aktif
$qDana = mysqli_query($conn, "
    SELECT *
    FROM danaawal
    WHERE user_id='$user_id'
    AND status='aktif'
    LIMIT 1
");

if (mysqli_num_rows($qDana) == 0) {

    echo "<script>
        alert('Silakan input dana terlebih dahulu!');
        window.location='/OGIKFINANC/user.php?url=lihat-catatan';
    </script>";
    exit;
}

$dataDana = mysqli_fetch_assoc($qDana);

// Cek saldo cukup atau tidak
if ($harga > $dataDana['jumlah']) {

    echo "<script>
        alert('Saldo tidak mencukupi!');
        window.location='/OGIKFINANC/user.php?url=pengeluaran';
    </script>";
    exit;
}

// Nonaktifkan dana lama
mysqli_query($conn, "
    UPDATE danaawal
    SET status='nonaktif'
    WHERE id_danaawal='{$dataDana['id_danaawal']}'
");

// Hitung saldo baru
$saldoBaru = $dataDana['jumlah'] - $harga;

// Simpan snapshot dana baru
mysqli_query($conn, "
    INSERT INTO danaawal(
        user_id,
        jumlah,
        status
    )
    VALUES(
        '$user_id',
        '$saldoBaru',
        'aktif'
    )
");

// Ambil id dana baru
$idDanaBaru = mysqli_insert_id($conn);

// Simpan pengeluaran
mysqli_query($conn, "
    INSERT INTO catatan_pengeluaran(
        user_id,
        id_danaawal,
        tanggal,
        nama_barang,
        lokasi,
        jenis_barang,
        harga,
        metode_pembayaran,
        catatan
    )
    VALUES(
        '$user_id',
        '$idDanaBaru',
        '$tanggal',
        '$nama_barang',
        '$lokasi',
        '$jenis_barang',
        '$harga',
        '$metode_pembayaran',
        '$catatan'
    )
");

header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
exit;
