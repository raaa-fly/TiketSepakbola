<?php
include 'koneksi.php';

$query = "SELECT p.id, p.nama_pemesan, p.jumlah_tiket, p.total_harga, p.tanggal_pesan,
                 pt.tim_home, pt.tim_away
          FROM pemesanan p
          JOIN pertandingan pt ON p.id_pertandingan = pt.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Pemesanan</title>
</head>
<body>
    <h1>Daftar Pemesanan Tiket</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Pemesan</th>
            <th>Jumlah Tiket</th>
            <th>Total Harga</th>
            <th>Tanggal Pesan</th>
            <th>Pertandingan</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['nama_pemesan']; ?></td>
                <td><?= $row['jumlah_tiket']; ?></td>
                <td>Rp<?= number_format($row['total_harga'], 2, ',', '.'); ?></td>
                <td><?= $row['tanggal_pesan']; ?></td>
                <td><?= $row['tim_home']; ?> vs <?= $row['tim_away']; ?></td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
