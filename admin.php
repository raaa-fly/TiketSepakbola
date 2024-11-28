<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_tiket_liga_satu";

$conn = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil data dari tabel pemesanan
$queryPemesanan = "SELECT * FROM pemesanan";
$resultPemesanan = mysqli_query($conn, $queryPemesanan);

// Ambil data dari tabel pertandingan
$queryPertandingan = "SELECT * FROM pertandingan";
$resultPertandingan = mysqli_query($conn, $queryPertandingan);

// Proses hapus data pemesanan
if (isset($_GET['hapus'])) {
    $idHapus = $_GET['hapus'];
    $queryHapus = "DELETE FROM pemesanan WHERE id = $idHapus";
    mysqli_query($conn, $queryHapus);

    // Refresh halaman
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

// Proses edit data pertandingan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['waktu'];
    $tim_home = $_POST['tim_home'];
    $tim_away = $_POST['tim_away'];
    $lokasi = $_POST['lokasi'];
    $harga = $_POST['harga'];

    // Jika ada file gambar yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($gambar);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile);

        // Update dengan gambar baru
        $queryUpdate = "UPDATE pertandingan SET 
                        tanggal = '$tanggal', waktu = '$waktu', 
                        tim_home = '$tim_home', tim_away = '$tim_away', 
                        lokasi = '$lokasi', harga = '$harga', gambar = '$gambar' 
                        WHERE id = $id";
    } else {
        // Update tanpa gambar baru
        $queryUpdate = "UPDATE pertandingan SET 
                        tanggal = '$tanggal', waktu = '$waktu', 
                        tim_home = '$tim_home', tim_away = '$tim_away', 
                        lokasi = '$lokasi', harga = '$harga' 
                        WHERE id = $id";
    }

    mysqli_query($conn, $queryUpdate);

    // Refresh halaman
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Daftar Pemesanan & Pertandingan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            color: #333;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        .edit-form {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            margin-top: 20px;
        }

        .edit-form h2 {
            text-align: center;
            color: #007bff;
        }

        .edit-form form {
            display: flex;
            flex-direction: column;
        }

        .edit-form label {
            margin: 10px 0 5px;
            font-weight: bold;
        }

        .edit-form input {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .edit-form button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .edit-form button:hover {
            background: #0056b3;
        }

        .action-links a {
            color: #dc3545;
            text-decoration: none;
        }

        .action-links a:hover {
            color: #a71d2a;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="header">
        <h1>Daftar Pemesanan</h1>
    </div>

    <!-- Logout Button -->
    <div style="text-align: center; margin-top: 20px;">
        <form action="logout.php" method="POST">
            <button type="submit" style="padding: 10px 20px; background: #dc3545; color: white; border: none; border-radius: 5px;">Logout</button>
        </form>
    </div>


    <!-- Tabel Daftar Pemesanan -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Pertandingan</th>
                <th>Nama Pemesan</th>
                <th>Jumlah Tiket</th>
                <th>Total Harga</th>
                <th>Tanggal Pesan</th>
                <th>Metode Pembayaran</th>
                <th>Detail Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultPemesanan)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['id_pertandingan']); ?></td>
                    <td><?= htmlspecialchars($row['nama_pemesan']); ?></td>
                    <td><?= htmlspecialchars($row['jumlah_tiket']); ?></td>
                    <td>Rp<?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td><?= htmlspecialchars($row['tanggal_pesan']); ?></td>
                    <td><?= htmlspecialchars($row['payment_method']); ?></td>
                    <td><?= htmlspecialchars($row['payment_details']); ?></td>
                    <td class="action-links">
                        <a href="?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus pesanan ini?')">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Tabel Daftar Pertandingan -->
    <div class="header">
        <h1>Daftar Pertandingan</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Tim Home</th>
                <th>Tim Away</th>
                <th>Lokasi</th>
                <th>Harga</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($resultPertandingan)) { ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td><?= htmlspecialchars($row['waktu']); ?></td>
                    <td><?= htmlspecialchars($row['tim_home']); ?></td>
                    <td><?= htmlspecialchars($row['tim_away']); ?></td>
                    <td><?= htmlspecialchars($row['lokasi']); ?></td>
                    <td>Rp<?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td><img src="uploads/<?= htmlspecialchars($row['gambar']); ?>" alt="Gambar" width="50"></td>
                    <td class="action-links">
                        <!-- Tombol Edit -->
<a href="edit.php?edit=<?= $row['id']; ?>">
    <button>Edit</button>
</a>

                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
