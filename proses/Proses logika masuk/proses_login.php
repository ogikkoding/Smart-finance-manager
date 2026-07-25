<?php
session_start();

require __DIR__ . '/../../database/koneksi.php';

// Pastikan koneksi berhasil
if (!$conn) {
	die("Koneksi database gagal : " . mysqli_connect_error());
}

// Cek apakah form dikirim
if (isset($_POST['email']) && isset($_POST['password'])) {

	$email = mysqli_real_escape_string($conn, trim($_POST['email']));
	$password = trim($_POST['password']);

	// Cari akun berdasarkan email
	$query = mysqli_query($conn, "SELECT * FROM akun WHERE email='$email'");

	if (!$query) {
		die("Query Error : " . mysqli_error($conn));
	}

	if (mysqli_num_rows($query) == 1) {

		$data = mysqli_fetch_assoc($query);

		// Jika password menggunakan password_hash()
		if (password_verify($password, $data['password'])) {

			session_regenerate_id(true);

			$_SESSION['login']    = true;
			$_SESSION['id']       = $data['id'];
			$_SESSION['username'] = $data['username'];
			$_SESSION['email']    = $data['email'];

			header("Location: /OGIKFINANC/user.php?url=dashboard");
			exit;
		} else {

			echo "<script>
                    alert('Password salah!');
                   window.location='/OGIKFINANC/login.php';
                  </script>";
			exit;
		}
	} else {

		echo "<script>
                alert('Email tidak ditemukan!');
               window.location='/OGIKFINANC/login.php';
              </script>";
		exit;
	}
} else {

	header("Location: /OGIKFINANC/login.php");
	exit;
}
