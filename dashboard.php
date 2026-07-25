<?php
require_once __DIR__ . '/database/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: /OGIKFINANC/login.php");
    exit;
}

$user_id = $_SESSION['id'];

/* =======================
   DANA AKTIF
======================= */

$danaAktif = mysqli_query($conn, "
SELECT *
FROM danaawal
WHERE user_id='$user_id'
AND status='aktif'
LIMIT 1
");

$dataDana = mysqli_fetch_assoc($danaAktif);

$danaAwal = $dataDana ? $dataDana['jumlah'] : 0;


/* =======================
   TOTAL PENGELUARAN
======================= */

$qPengeluaran = mysqli_query($conn, "
SELECT IFNULL(SUM(harga),0) AS total
FROM catatan_pengeluaran
WHERE user_id='$user_id'
");

$totalPengeluaran = mysqli_fetch_assoc($qPengeluaran)['total'];


/* =======================
   SISA DANA
======================= */

$sisaDana = $danaAwal - $totalPengeluaran;


/* =======================
   DATA GRAFIK
======================= */

$namaBulan = [
    1 => "Jan",
    2 => "Feb",
    3 => "Mar",
    4 => "Apr",
    5 => "Mei",
    6 => "Jun",
    7 => "Jul",
    8 => "Agu",
    9 => "Sep",
    10 => "Okt",
    11 => "Nov",
    12 => "Des"
];

$dataGrafik = array_fill(1, 12, 0);

$queryGrafik = mysqli_query($conn, "
SELECT
MONTH(tanggal) AS bulan,
SUM(harga) AS total
FROM catatan_pengeluaran
WHERE user_id='$user_id'
GROUP BY MONTH(tanggal)
");

while ($row = mysqli_fetch_assoc($queryGrafik)) {

    $bulan = (int)$row['bulan'];
    $dataGrafik[$bulan] = (float)$row['total'];
}

?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="css/dashboard.css">

<div class="container-fluid">

    <!-- Judul -->
    <div class="mb-4">
        <h2 class="font-weight-bold text-primary">
            <i class="fas fa-home"></i>
            Dashboard
        </h2>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Selamat Datang Di OgikFinanc
                    </h6>
                </div>
                <div class="card-body">
                    <h5>
                        Halo,
                        <?= htmlspecialchars($_SESSION['username']); ?>
                    </h5>

                    <p class="mb-0">
                        Selamat Datang Di Website Pengelolaan Keuangan Pribadi
                        <strong>OGIKFINANC</strong>.
                        Gunakan menu di sebelah kiri untuk
                        mencatat pengeluaran, melihat riwayat
                        transaksi, mengelola dana, dan
                        menggunakan fitur lainnya.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Statistik -->
    <div class="row">

        <!-- Dana Awal -->
        <div class="col-md-4 mb-4">

            <div class="card border-left-primary shadow h-100">

                <div class="card-body">

                    <h6 class="text-primary font-weight-bold">
                        Dana Awal
                    </h6>

                    <h4 class="mb-0">
                        Rp <?= number_format($danaAwal, 0, ",", "."); ?>
                    </h4>

                </div>

            </div>

        </div>

        <!-- Pengeluaran -->
        <div class="col-md-4 mb-4">

            <div class="card border-left-danger shadow h-100">

                <div class="card-body">

                    <h6 class="text-danger font-weight-bold">
                        Total Pengeluaran
                    </h6>

                    <h4 class="mb-0">
                        Rp <?= number_format($totalPengeluaran, 0, ",", "."); ?>
                    </h4>

                </div>

            </div>

        </div>

        <!-- Sisa Dana -->
        <div class="col-md-4 mb-4">

            <div class="card border-left-success shadow h-100">

                <div class="card-body">

                    <h6 class="text-success font-weight-bold">
                        Sisa Dana
                    </h6>

                    <h4 class="mb-0">
                        Rp <?= number_format($sisaDana, 0, ",", "."); ?>
                    </h4>

                </div>

            </div>

        </div>

    </div>

    <!-- Grafik -->
    <div class="row">

        <div class="col-12">

            <div class="card shadow mb-4">

                <div class="card-header">

                    <h5 class="mb-0">

                        <i class="fas fa-chart-bar text-primary"></i>

                        Grafik Pengeluaran Per Bulan

                    </h5>

                </div>

                <div class="card-body">

                    <canvas
                        id="grafikPengeluaran"
                        height="100">
                    </canvas>

                </div>

            </div>

        </div>

    </div>

</div>

<script>
    const ctx = document
        .getElementById('grafikPengeluaran')
        .getContext('2d');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: [

                <?php
                foreach ($namaBulan as $bulan) {
                    echo "'$bulan',";
                }
                ?>

            ],

            datasets: [{

                label: 'Pengeluaran',

                data: [

                    <?php
                    foreach ($dataGrafik as $nilai) {
                        echo $nilai . ",";
                    }
                    ?>

                ],

                backgroundColor: '#4e73df',
                hoverBackgroundColor: '#2e59d9',

                borderRadius: 8,
                borderWidth: 1

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: true,

            animation: {
                duration: 1500,
                easing: 'easeOutQuart'
            },

            interaction: {
                mode: 'index',
                intersect: false
            },

            plugins: {

                legend: {
                    display: false
                },

                tooltip: {

                    backgroundColor: '#ffffff',

                    titleColor: '#333',

                    bodyColor: '#333',

                    borderColor: '#4e73df',

                    borderWidth: 1,

                    cornerRadius: 8,

                    displayColors: false,

                    callbacks: {

                        label: function(context) {

                            return 'Rp ' +
                                context.parsed.y.toLocaleString('id-ID');

                        }

                    }

                }

            },

            scales: {

                x: {

                    grid: {

                        display: false

                    }

                },

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp ' +
                                value.toLocaleString('id-ID');

                        }

                    }

                }

            }

        }

    });
</script>