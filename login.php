<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>OGIKFINANC - Login</title>

  <!-- Font Awesome -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- SB Admin 2 -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-5 col-lg-6 col-md-8">
        <div class="card shadow-lg my-5">
          <div class="card-body p-5">
            <div class="text-center">
              <h2 class="text-primary font-weight-bold">
                OGIKFINANC
              </h2>

              <p class="mb-4 text-gray-600">
                Silakan login ke akun Anda
              </p>

            </div>
            <form method="POST" action="/OGIKFINANC/proses/Proses logika masuk/proses_login.php">
              <!-- Email -->
              <div class="form-group">
                <label>Email</label>

                <input
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="Masukkan Email"
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
                  placeholder="Masukkan Password"
                  required
                  autocomplete="current-password">
              </div>

              <button
                type="submit"
                class="btn btn-primary btn-block">
                Login
              </button>
              <a href="register.php">Belum punya akun? Silahkan Daftar</a>
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