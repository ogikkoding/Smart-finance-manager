<?php
session_start();

// Hapus semua session
$_SESSION = [];
session_destroy();

// Hapus cache browser
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect
header("Location: login.php");
exit;
