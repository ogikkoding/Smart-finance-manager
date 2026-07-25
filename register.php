<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>OGIKFINANC - Register</title>

  <!-- Font Awesome -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

  <!-- SB Admin 2 -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="row justify-content-center">

      <div class="col-lg-6 col-md-8">

        <div class="card shadow-lg my-5">

          <div class="card-body p-5">

            <div class="text-center">

              <h2 class="text-primary font-weight-bold mb-3">
                <i class="fas fa-user-plus"></i>
                DAFTAR AKUN
              </h2>

              <p class="text-gray-600">
                Lengkapi data berikut untuk membuat akun baru.
              </p>

            </div>

            <form method="POST" action="/OGIKFINANC/proses/Proses logika masuk/proses_register.php">
              <!-- Nama -->
              <div class="form-group">
                <label>Nama Lengkap</label>

                <input
                  type="text"
                  name="nama"
                  class="form-control"
                  placeholder="Masukkan nama lengkap"
                  required
                  autocomplete="name">

              </div>

              <!-- Username -->
              <div class="form-group">
                <label>Username</label>

                <input
                  type="text"
                  name="username"
                  class="form-control"
                  placeholder="Masukkan username"
                  required
                  autocomplete="username">

              </div>

              <!-- Email -->
              <div class="form-group">
                <label>Email</label>

                <input
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Masukkan email"
                  required
                  autocomplete="email">

              </div>

              <!-- Password -->
              <div class="form-group">
                <label>Password</label>

                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="Masukkan password"
                  required
                  minlength="8"
                  autocomplete="new-password">

                <small class="text-muted">
                  Minimal 8 karakter.
                </small>

              </div>

              <!-- Tombol -->
              <button
                type="submit"
                class="btn btn-primary btn-block">
                <i class="fas fa-user-plus"></i>
                Daftar Sekarang

              </button>

              <hr>

              <a
                href="login.php"
                class="btn btn-secondary btn-block">

                <i class="fas fa-sign-in-alt"></i>
                Sudah punya akun? Login

              </a>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>