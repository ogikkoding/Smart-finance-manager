<?php
// ======================================================
// PROSES CADANGKAN DATABASE
// ======================================================

session_start();

if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

// =======================
// KONFIGURASI DATABASE
// =======================

$host = "localhost";
$user = "root";
$pass = "";
$db   = "nama_database"; // Ganti dengan nama database kamu

// =======================
// NAMA FILE
// =======================

$namaBackup = trim($_POST['nama_backup']);

if ($namaBackup == "") {
    $namaBackup = "backup_" . date("Y-m-d_H-i-s");
}

$namaFile = $namaBackup . ".sql";

// =======================
// LOKASI mysqldump
// =======================

$mysqldump = "C:\\xampp\\mysql\\bin\\mysqldump.exe";

// =======================
// HEADER DOWNLOAD
// =======================

header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$namaFile\"");

// =======================
// EKSEKUSI BACKUP
// =======================

$command = "\"$mysqldump\" --host=$host --user=$user";
if ($pass != "") {
    $command .= " --password=$pass";
}
$command .= " $db";

passthru($command);

exit;
