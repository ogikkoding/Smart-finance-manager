<?php
session_start();

require_once __DIR__ . '/../../database/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/user.php");
    exit;
}

$user_id = $_SESSION['id'];
$action  = $_POST['action'] ?? '';

// Ambil dana aktif
$qDana = mysqli_query($conn, "
    SELECT *
    FROM danaawal
    WHERE user_id='$user_id'
    AND status='aktif'
    LIMIT 1
");

$dataDana = mysqli_fetch_assoc($qDana);

/* ===========================
   TAMBAH DANA / DANA AWAL
=========================== */

if ($action == "tambah") {

    $jumlahTambah = (float) ($_POST['jumlah'] ?? 0);

    if ($jumlahTambah <= 0) {
        die("Jumlah dana tidak valid.");
    }

    // Kalau ada dana aktif
    if ($dataDana) {

        // Nonaktifkan dana lama
        mysqli_query($conn, "
            UPDATE danaawal
            SET status='nonaktif'
            WHERE id_danaawal='{$dataDana['id_danaawal']}'
        ");

        // Hitung saldo baru
        $saldoBaru = $dataDana['jumlah'] + $jumlahTambah;
    } else {

        // Dana pertama
        $saldoBaru = $jumlahTambah;
    }

    // Simpan data baru
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
}

/* ===========================
   RESET DANA
=========================== */ elseif ($action == "reset") {

    if ($dataDana) {

        mysqli_query($conn, "
            UPDATE danaawal
            SET status='nonaktif'
            WHERE id_danaawal='{$dataDana['id_danaawal']}'
        ");
    }
}

header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
exit;
