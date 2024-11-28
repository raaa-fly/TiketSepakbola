<?php
include 'koneksi.php';

$query = "SELECT * FROM pertandingan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Tiket Liga Satu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styling dasar untuk halaman */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 15px 30px;
            background: rgba(255, 255, 255, 0.1); /* Transparan */
            backdrop-filter: blur(10px); /* Efek blur pada background */
            color: #fff;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease-in-out;
        }
        .navbar:hover {
            background: rgba(255, 255, 255, 0.2); /* Efek hover */
        }
        .navbar .logo {
            display: flex;
            align-items: center;
        }
        .navbar .logo img {
            height: 70px; /* Sesuaikan ukuran logo */
            margin-right: 10px; /* Spasi antara logo dan teks */
            margin-left: 30px; /* Spasi antara logo dan teks */
        }
        .navbar a {
            color: #fff;
            text-decoration: none;
            padding: 10px 15px;
            font-weight: bold;
            transition: color 0.3s;
        }
        .navbar a:hover {
            color: #ffdd57;
        }
        .navbar .menu {
            display: flex;
        }

        .title {
            color: #fff;
            margin: 20px 0;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
            font-size: 24px;
            width: 100%;
            text-align: left;
            padding-left: 30px;
        }

        /* Layout utama untuk pertandingan dan klasemen */
        .main-content {
            display: flex;
            width: 90%;
            max-width: 1200px;
            gap: 20px;
            padding: 20px;
        }

        /* Kontainer informasi pertandingan */
        .match-container {
            flex: 3;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .match-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            padding: 15px;
            overflow: hidden;
        }
        .match-card img {
            width: 120px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 15px;
        }
        .match-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .date-time, .location {
            font-size: 0.9em;
            color: #666;
            margin: 5px 0;
        }
        .button a {
            text-decoration: none;
            color: #fff;
            background: #007bff;
            padding: 5px 15px;
            border-radius: 5px;
            transition: background 0.3s;
            font-weight: bold;
        }
        .button a:hover {
            background: #0056b3;
        }

        /* Kontainer klasemen */


.standings {
    flex: 1;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    padding: 50px;
    height: fit-content;
}
.standings h3 {
    font-size: 1.2em;
    color: #333;
    margin-bottom: 10px;
    text-align: center;
}

table {
    width: 100%;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}
th {
    background-color: #f5f5f5;
    font-weight: bold;
}
tr:nth-child(even) {
    background-color: #f9f9f9;
}
tr:hover {
    background-color: #f1f1f1;
}
.custom-login-btn {
        background-color: #007bff; /* Blue background */
        color: white; /* White text */
        border: none; /* No border */
        padding: 10px 20px; /* Padding for the button */
        border-radius: 5px; /* Rounded corners */
        margin-right: 15px;
        text-decoration: none; /* No underline */
        transition: background-color 0.3s; /* Smooth transition for hover effect */
    }

    .custom-login-btn:hover {
        background-color: #0056b3; /* Darker blue on hover */
    }
    </style>
</head>
<body>

    <!-- Navbar -->

    <div class="navbar">
    <div class="logo">
        <img src="img/logo.png" alt="Logo Liga Satu">
        <div style="font-family: Arial, sans-serif; font-weight: bold; font-size: 20px;">Tiket Liga Satu</div>
    </div>
    <div class="menu">
        <a href="beranda.php">Beranda</a>
        <a href="index.php">Daftar Pertandingan</a>
        <a href="carapemesanan.php">Cara Pemesanan</a>
        <a href="kontak.php">Kontak</a>
        <a href="login.php" class="custom-login-btn" style="margin-left: 15px;">Login</a> <!-- Custom Login Button -->
    </div>
</div>
    <!-- Judul -->
    <h2 class="title">Pertandingan Terkini</h2>

    <!-- Layout utama dengan pertandingan dan klasemen -->
    <div class="main-content">
        <!-- Informasi pertandingan -->
        <div class="match-container">
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="match-card">
                    <img src="img/pertandingan/<?= $row['gambar'] ? $row['gambar'] : 'default.jpg'; ?>" alt="Foto Pertandingan">
                    
                    <div class="match-details">
                        <div class="date-time">
                            <i class="fas fa-calendar-alt"></i> <?= date('d M Y', strtotime($row['tanggal'])); ?>
                            <i class="fas fa-clock"></i> <?= date('H:i', strtotime($row['waktu'])); ?> WIB
                        </div>
                        <div class="team-names"><?= $row['tim_home']; ?> vs <?= $row['tim_away']; ?></div>
                        <div class="location"><i class="fas fa-map-marker-alt"></i> <?= $row['lokasi']; ?></div>
                        <div class="button">
                            <a href="pesan.php?id=<?= $row['id']; ?>">PESAN SEKARANG</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Klasemen -->
        <div class="standings">
            <h3>Klasemen Liga Satu</h3>
            <table>
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Klub</th>
                        <th>Poin</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td>1</td><td>Borneo FC</td><td>21</td></tr>
                    <tr><td>2</td><td>Persebaya</td><td>21</td></tr>
                    <tr><td>3</td><td>Persib Bandung</td><td>20</td></tr>
                    <tr><td>4</td><td>Bali United</td><td>20</td></tr>
                    <tr><td>5</td><td>Persija Jakarta</td><td>18</td></tr>
                    <tr><td>6</td><td>PSM Makassar</td><td>17</td></tr>
                    <tr><td>7</td><td>PSBS Biak</td><td>15</td></tr>
                    <tr><td>8</td><td>Persik</td><td>15</td></tr>
                    <tr><td>9</td><td>Arema FC</td><td>15</td></tr>
                    <tr><td>10</td><td>Persita</td><td>15</td></tr>
                    <tr><td>11</td><td>Dewa United</td><td>11</td></tr>
                    <tr><td>12</td><td>Malut United</td><td>11</td></tr>
                    <tr><td>13</td><td>Barito Putera</td><td>9</td></tr>
                    <tr><td>14</td><td>PSS</td><td>8</td></tr>
                    <tr><td>15</td><td>PSIS</td><td>7</td></tr>
                    <tr><td>16</td><td>Persis</td><td>7</td></tr>
                    <tr><td>17</td><td>Madura United</td><td>6</td></tr>
                    <tr><td>18</td><td>Semen Padang</td><td>5</td></tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>