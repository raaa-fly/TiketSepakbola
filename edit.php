<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_tiket_liga_satu";


// Buat koneksi
$conn = mysqli_connect($host, $user, $password, $dbname);

// Cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah ID pertandingan ada di URL
$rowEdit = null; // Inisialisasi variabel
if (isset($_GET['edit'])) {
    $idEdit = $_GET['edit'];

    // Pastikan ID berupa angka untuk mencegah SQL Injection
    $idEdit = mysqli_real_escape_string($conn, $idEdit);

    // Query untuk mengambil data pertandingan berdasarkan ID
    $queryEdit = "SELECT * FROM pertandingan WHERE id = $idEdit";
    $resultEdit = mysqli_query($conn, $queryEdit);

    // Jika data ditemukan, ambil hasilnya
    if (mysqli_num_rows($resultEdit) > 0) {
        $rowEdit = mysqli_fetch_assoc($resultEdit);
    } else {
        echo "Pertandingan tidak ditemukan!";
        exit; // Keluar jika tidak ada pertandingan
    }
}

// Proses pembaruan data pertandingan
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

    // Jalankan query dan periksa kesalahan
    if (mysqli_query($conn, $queryUpdate)) {
        // Redirect ke halaman admin setelah update berhasil
        header("Location: admin.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pertandingan</title>
    <style>
        /* CSS styles */
    </style>
</head>
<body>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    h2 {
        text-align: center;
        color: #2c3e50;
        padding: 20px;
    }

    form {
        width: 50%;
        margin: 0 auto;
        background-color: #fff;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        font-size: 14px;
        font-weight: bold;
        color: #34495e;
        margin-bottom: 8px;
        display: block;
    }

    input[type="date"],
    input[type="time"],
    input[type="text"],
    input[type="number"],
    input[type="file"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0 20px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    input[type="file"] {
        padding: 0;
    }

    button {
        background-color: #2980b9;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        background-color: #3498db;
    }

    .file-label {
        font-size: 12px;
        color: #7f8c8d;
        margin-top: -10px;
        display: block;
        margin-bottom: 15px;
    }

    .file-label a {
        color: #2980b9;
        text-decoration: none;
    }

    .file-label a:hover {
        text-decoration: underline;
    }
</style>


    <!-- Form untuk mengedit data pertandingan -->
    <h2>Edit Pertandingan</h2>
    <form action="edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= isset($rowEdit['id']) ? $rowEdit['id'] : ''; ?>">

        <label for="tanggal">Tanggal:</label>
        <input type="date" name="tanggal" value="<?= isset($rowEdit['tanggal']) ? $rowEdit['tanggal'] : ''; ?>" required>

        <label for="waktu">Waktu:</label>
        <input type="time" name="waktu" value="<?= isset($rowEdit['waktu']) ? $rowEdit['waktu'] : ''; ?>" required>

        <label for="tim_home">Tim Home:</label>
        <input type="text" name="tim_home" value="<?= isset($rowEdit['tim_home']) ? $rowEdit['tim_home'] : ''; ?>" required>

        <label for="tim_away">Tim Away:</label>
        <input type="text" name="tim_away" value="<?= isset($rowEdit['tim_away']) ? $rowEdit['tim_away'] : ''; ?>" required>

        <label for="lokasi">Lokasi:</label>
        <input type="text" name="lokasi" value="<?= isset($rowEdit['lokasi']) ? $rowEdit['lokasi'] : ''; ?>" required>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" value="<?= isset($rowEdit['harga']) ? $rowEdit['harga'] : ''; ?>" required>

        <label class="file-label">(sebelum upload, pastikan rename gambar menjadi sesuai pertandingan yang di rubah contoh:"Pertandingan4.jpg");</label>
        <input type="file" name="gambar">

        <button type="submit">Simpan Perubahan</button>
    </form>

</body>
</html>
