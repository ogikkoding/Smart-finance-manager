<?php
session_start();
require __DIR__ . '/../../database/koneksi.php';

if (!$conn) {
  die("Koneksi database gagal : " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $username = mysqli_real_escape_string($conn, trim($_POST['username']));
  $email    = mysqli_real_escape_string($conn, trim($_POST['email']));
  $password = trim($_POST['password']);

  if (empty($username) || empty($email) || empty($password)) {

    echo "<script>
            alert('Semua data wajib diisi!');
            window.location='/OGIKFINANC/register.php';
        </script>";
    exit;
  }

  // Cek username
  $cekUsername = mysqli_query(
    $conn,
    "SELECT id FROM akun WHERE username='$username'"
  );

  if (mysqli_num_rows($cekUsername) > 0) {

    echo "<script>
            alert('Username sudah digunakan!');
            window.location='/OGIKFINANC/register.php';
        </script>";
    exit;
  }

  // Cek email
  $cekEmail = mysqli_query(
    $conn,
    "SELECT id FROM akun WHERE email='$email'"
  );

  if (mysqli_num_rows($cekEmail) > 0) {

    echo "<script>
            alert('Email sudah terdaftar!');
            window.location='/OGIKFINANC/register.php';
        </script>";
    exit;
  }

  $passwordHash = password_hash($password, PASSWORD_ARGON2ID);

  $query = mysqli_query(
    $conn,
    "INSERT INTO akun(username,email,password)
        VALUES('$username','$email','$passwordHash')"
  );

  if ($query) {

    echo "<script>
            alert('Pendaftaran berhasil!');
            window.location='/OGIKFINANC/login.php';
        </script>";
  } else {

    echo "<script>
            alert('Pendaftaran gagal!');
            window.location='/OGIKFINANC/register.php';
        </script>";
  }
}
