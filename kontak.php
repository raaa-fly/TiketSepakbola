<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kontak - Tiket Liga Satu</title>
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

        /* Kontainer kontak */
        .contact-info {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 90%;
            max-width: 800px;
            margin: 20px;
        }

        .contact-info h3 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .contact-info p {
            color: #333;
            line-height: 1.6;
        }

        .contact-info .social-media {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .contact-info .social-media a {
            color: #007bff;
            font-size: 24px;
            text-decoration: none;
        }

        .contact-info .social-media a:hover {
            color: #6610f2;
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
    </div>

    <!-- Judul -->
    <h2 class="title">Kontak Kami</h2>

    <!-- Kontainer kontak -->
    <div class="contact-info">
        <h3>Hubungi Kami</h3>
        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan, Anda dapat menghubungi kami melalui informasi kontak di bawah ini:</p>
        <p><strong>Telepon:</strong> (021) 123-4567</p>
        <p><strong>Email:</strong> info@tiketligasatu.com</p>
        <p><strong>Alamat:</strong> Jl. Raya Stadion No. 10, Jakarta, Indonesia</p>
        
        <h4>Ikuti kami di media sosial:</h4>
        <div class="social-media">
            <a href="https://facebook.com/tiketligasatu" target="_blank" class="fab fa-facebook"></a>
            <a href="https://twitter.com/tiketligasatu" target="_blank" class="fab fa-twitter"></a>
            <a href="https://instagram.com/tiketligasatu" target="_blank" class="fab fa-instagram"></a>
        </div>
    </div>

</body>
</html>
