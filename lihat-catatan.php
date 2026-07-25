<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

require_once __DIR__ . '/database/koneksi.php';

if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$user_id = $_SESSION['id'];

/* ===========================
   DATA DANA AKTIF
=========================== */

$queryDana = mysqli_query($conn, "
    SELECT *
    FROM danaawal
    WHERE user_id = '$user_id'
    AND status = 'aktif'
    LIMIT 1
");

$dataDana = mysqli_fetch_assoc($queryDana);
?>

<link rel="stylesheet" href="css/lihat_catatan.css">
<!-- ======================================
            CARD DANA
======================================= -->

<div class="card shadow mb-4">
  <div class="card-header bg-success text-white">
    <h5 class="mb-0">
      <i class="fas fa-wallet mr-2"></i>
      Dana Saya
    </h5>
  </div>
  <div class="card-body">
    <?php if ($dataDana): ?>
      <div class="row align-items-center">

        <!-- Informasi Dana -->

        <div class="col-lg-6">
          <small class="text-muted">

            Saldo Saat Ini

          </small>

          <h2 class="text-success font-weight-bold my-2">
            Rp <?= number_format($dataDana['jumlah'], 0, ',', '.'); ?>

          </h2>

          <small class="text-muted">

            <i class="far fa-calendar-alt"></i>

            Dibuat :

            <?= date('d-m-Y H:i', strtotime($dataDana['created_at'])); ?>

          </small>

        </div>

        <!-- Tombol -->

        <div class="col-lg-6 text-lg-right mt-4 mt-lg-0">

          <button
            type="button"
            class="btn btn-primary"
            data-toggle="collapse"
            data-target="#formTambahDana">

            <i class="fas fa-plus"></i>

            Tambah Dana

          </button>

          <form
            action="/OGIKFINANC/proses/Proses logika/proses_dana_awal.php"
            method="POST"
            class="d-inline">

            <input
              type="hidden"
              name="action"
              value="reset">

            <button
              type="submit"
              class="btn btn-danger"
              onclick="return confirm('Yakin ingin mengakhiri dana ini? Dana akan dinonaktifkan.')">

              <i class="fas fa-power-off"></i>

              Reset Dana

            </button>

          </form>

        </div>

      </div>

      <!-- ===========================
                    FORM TAMBAH DANA
            =========================== -->

      <div
        id="formTambahDana"
        class="collapse mt-4">

        <hr>

        <form
          action="/OGIKFINANC/proses/Proses logika/proses_dana_awal.php"
          method="POST">

          <input
            type="hidden"
            name="action"
            value="tambah">

          <div class="form-group">

            <label>

              Tambah Dana

            </label>

            <input
              type="number"
              name="jumlah"
              class="form-control"
              min="1"
              placeholder="Masukkan nominal..."
              required>

          </div>

          <button
            type="submit"
            class="btn btn-success">

            <i class="fas fa-save"></i>

            Tambah Dana

          </button>

        </form>

      </div>

    <?php else: ?>

      <!-- ===========================
                    BELUM ADA DANA
            =========================== -->

      <div class="alert alert-warning">

        <i class="fas fa-wallet"></i>

        Belum ada dana aktif.

        Silakan masukkan dana awal terlebih dahulu.

      </div>

      <!-- ===========================
                    FORM DANA AWAL
            =========================== -->

      <form
        action="/OGIKFINANC/proses/Proses logika/proses_dana_awal.php"
        method="POST">

        <input
          type="hidden"
          name="action"
          value="tambah">

        <div class="form-group">

          <label>

            Dana Awal

          </label>

          <input
            type="number"
            name="jumlah"
            class="form-control"
            min="1"
            placeholder="Masukkan dana awal..."
            required>

        </div>

        <button
          type="submit"
          class="btn btn-success">

          <i class="fas fa-save"></i>

          Simpan Dana Awal

        </button>

      </form>

    <?php endif; ?>

  </div>

</div>

<!-- ======================================
        CATATAN PENGELUARAN
======================================= -->

<div class="card shadow mb-4">

  <div class="card-header py-3">

    <h5 class="m-0 font-weight-bold text-primary">

      <i class="fas fa-book mr-2"></i>

      Catatan Pengeluaran

    </h5>

  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table
        class="table table-bordered"
        id="dataTable"
        width="100%"
        cellspacing="0">

        <thead>

          <tr>

            <th>No</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Lokasi</th>
            <th>Jenis Barang</th>
            <th>Harga</th>
            <th>Metode Pembayaran</th>
            <th>Catatan</th>
            <th class="text-center">Aksi</th>

          </tr>

        </thead>

        <tbody>

          <?php

          $no = 1;

          $query = mysqli_query($conn, "
                        SELECT *
                        FROM catatan_pengeluaran
                        WHERE user_id = '$user_id'
                        ORDER BY tanggal DESC, id_cp DESC
                    ");

          while ($row = mysqli_fetch_assoc($query)) :
          ?>

            <tr>

              <td><?= $no++; ?></td>

              <td>
                <?= date('d-m-Y', strtotime($row['tanggal'])); ?>
              </td>

              <td>
                <?= htmlspecialchars($row['nama_barang']); ?>
              </td>

              <td>
                <?= htmlspecialchars($row['lokasi']); ?>
              </td>

              <td>
                <?= htmlspecialchars($row['jenis_barang']); ?>
              </td>

              <td>

                Rp <?= number_format($row['harga'], 0, ',', '.'); ?>

              </td>

              <td>

                <?= htmlspecialchars($row['metode_pembayaran']); ?>

              </td>

              <td>

                <?= htmlspecialchars($row['catatan']); ?>

              </td>

              <!-- Tombol Aksi -->

              <td class="text-center">

                <a
                  href="/OGIKFINANC/proses/Proses logika/edit_catatan.php?id=<?= $row['id_cp']; ?>"
                  class="btn btn-warning btn-sm"
                  title="Edit">

                  <i class="fas fa-edit"></i>

                </a>

                <a
                  href="/OGIKFINANC/proses/Proses logika/hapus_catatan.php?id=<?= $row['id_cp']; ?>"
                  class="btn btn-danger btn-sm"
                  title="Hapus"
                  onclick="return confirm('Yakin ingin menghapus data ini?')">

                  <i class="fas fa-trash"></i>

                </a>

              </td>

            </tr>

          <?php endwhile; ?>

        </tbody>

      </table>

    </div>

  </div>

  <!-- Footer -->

  <div class="card-footer text-right">

    <a
      href="user.php"
      class="btn btn-primary">

      <i class="fas fa-arrow-left mr-1"></i>

      Kembali

    </a>

  </div>

</div>