<?php
session_start();

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}
$email    = $_SESSION['email'];
$url = isset($_GET['url']) ? $_GET['url'] : "";
?>

<!DOCTYPE html>
<html lang="id">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OGIKFINANC</title>

  <!-- Font Awesome -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
  <!-- SB Admin -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <!-- DataTables -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Logo -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="user.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-wallet"></i>
        </div>
        <div class="sidebar-brand-text mx-2">
          OGIKFINANC
        </div>
      </a>
      <hr class="sidebar-divider my-0">

      <!-- Dashboard -->
      <li class="nav-item <?= empty($url) ? "active" : "" ?>">
        <a class="nav-link" href="?url=dashboard">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <div class="sidebar-heading">
        MENU
      </div>

      <!-- Lihat catatan-->
      <li class="nav-item <?= ($url == "lihat-catatan") ? "active" : "" ?>">
        <a class="nav-link" href="?url=lihat-catatan">
          <i class="fas fa-book-open"></i>
          <span>Lihat Catatan</span>
        </a>
      </li>

      <!-- tulis catatan pengeluaran-->
      <li class="nav-item <?= ($url == "tulis-catatan-pengeluaran") ? "active" : "" ?>">
        <a class="nav-link" href="?url=tulis-catatan-pengeluaran">
          <i class="fas fa-pen-alt"></i>
          <span>Catat Pengeluaran</span>
        </a>
      </li>

      <!-- note-->
      <li class="nav-item <?= ($url == "notes") ? "active" : "" ?>">
        <a class="nav-link" href="?url=notes">
          <i class="fas fa-book"></i>
          <span>Note</span>
        </a>
      </li>

      <!-- fitur lainnya-->
      <li class="nav-item <?= ($url == "fitur-lainnya") ? "active" : "" ?>">
        <a class="nav-link" href="?url=fitur-lainnya">
          <i class="fas fa-magic"></i>
          <span>Fitur Lainya</span>
        </a>
      </li>

      <hr class="sidebar-divider">

      <!-- Logout -->
      <li class="nav-item">
        <a class="nav-link" href="logout.php">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>

      <hr class="sidebar-divider d-none d-md-block">

      <!-- side bartoggle-->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">

        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop">
            <i class="fa fa-bars"></i>
          </button>
          <h4 class="text-primary font-weight-bold mb-0">
            SELAMAT DATANG DI OGIKFINANC
          </h4>
        </nav>
        <div class="container-fluid">



          <!-- AKSES MENU SIDE BAR-->
          <?php
          if (empty($url)) {
            // Dashboard
          } else {
            switch ($url) {

              case 'dana-awal':
                include 'dana-awal.php';
                break;

              case 'dashboard':
                include 'dashboard.php';
                break;

              case 'lihat-catatan':
                include 'lihat-catatan.php';
                break;

              case 'tulis-catatan-pengeluaran':
                include 'tulis_catatan_pengeluaran.php';
                break;

              case 'notes':
                include 'notes.php';
                break;

              case 'fitur-lainnya':
                include 'fitur_lainnya.php';
                break;

              case 'kalkulator':
                include 'fitur_lainnya/kalkulator.php';
                break;

              case 'cadangkan_data':
                include 'fitur_lainnya/cadangkan_data.php';
                break;

              default:
                echo "<div class='alert alert-danger'>
                    <i class='fas fa-exclamation-circle'></i>
                    Halaman tidak ditemukan.
                  </div>";
                break;
            }
          }
          ?>

        </div>
        <!-- End Container -->

      </div>
      <!-- End Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>
              Copyright &copy;
              <?= date('Y'); ?>
              OGIKFINANC
            </span>
          </div>
        </div>
      </footer>

    </div>
    <!-- End Content Wrapper -->

  </div>
  <!-- End Wrapper -->

  </div>
  <!-- End Wrapper -->

  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/sb-admin-2.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>