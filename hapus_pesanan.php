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

// Ambil ID dari parameter URL
$id = $_GET['id'];

// Pastikan ID ada dan valid
if (isset($id) && is_numeric($id)) {
    // Query untuk menghapus data
    $query = "DELETE FROM pemesanan WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Pesanan berhasil dihapus!');
                window.location.href = 'admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus pesanan.');
                window.location.href = 'admin.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak valid.');
            window.location.href = 'admin.php';
          </script>";
}

// Tutup koneksi
mysqli_close($conn);
?>
