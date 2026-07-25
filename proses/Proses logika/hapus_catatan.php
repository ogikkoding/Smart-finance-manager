<?php
session_start();

require_once __DIR__ . '/../../database/koneksi.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
    exit;
}

$user_id = $_SESSION['id'];
$id_cp   = (int) $_GET['id'];

// Hapus hanya data milik user yang sedang login
mysqli_query($conn, "
    DELETE FROM catatan_pengeluaran
    WHERE id_cp = '$id_cp'
    AND user_id = '$user_id'
");

header("Location: /OGIKFINANC/user.php?url=lihat-catatan");
exit;
