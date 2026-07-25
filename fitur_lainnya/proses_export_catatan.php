<?php
session_start();
require_once __DIR__ . '/../database/koneksi.php'; // sesuaikan dengan file koneksi

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Catatan_Pengeluaran_" . date('Y-m-d') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "<table border='1'>";

echo "
<tr style='background:#28a745;color:white;font-weight:bold;'>
    <th>No</th>
    <th>ID</th>
    <th>Tanggal</th>
    <th>Nama Barang</th>
    <th>Lokasi</th>
    <th>Jenis Barang</th>
    <th>Harga</th>
    <th>Metode Pembayaran</th>
    <th>Catatan</th>
    <th>Dibuat</th>
</tr>
";

$no = 1;

$query = mysqli_query($conn, "SELECT * FROM catatan_pengeluaran ORDER BY tanggal DESC");

while ($data = mysqli_fetch_assoc($query)) {

    echo "<tr>";

    echo "<td>" . $no++ . "</td>";
    echo "<td>" . $data['id_cp'] . "</td>";
    echo "<td>" . $data['tanggal'] . "</td>";
    echo "<td>" . $data['nama_barang'] . "</td>";
    echo "<td>" . $data['lokasi'] . "</td>";
    echo "<td>" . $data['jenis_barang'] . "</td>";
    echo "<td>Rp " . number_format($data['harga'], 0, ',', '.') . "</td>";
    echo "<td>" . $data['metode_pembayaran'] . "</td>";
    echo "<td>" . $data['catatan'] . "</td>";
    echo "<td>" . $data['created_at'] . "</td>";

    echo "</tr>";
}

echo "</table>";
exit;
