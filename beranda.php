<?php
include 'koneksi.php';

// Ambil berita dari database
$query = "SELECT * FROM berita ORDER BY tanggal DESC"; // Asumsikan ada tabel 'berita'
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Beranda - Tiket Liga Satu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
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

        /* Mengatur gambar carousel */
        .carousel-item img {
            width: 100%; /* Pastikan gambar menyesuaikan lebar carousel */
            height: 300px; /* Tetapkan tinggi tetap */
            object-fit: cover; /* Potong gambar agar memenuhi dimensi */
        }

        /* Menambahkan lapisan gradient hitam di bawah */
        .carousel-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 80%; /* Tinggi gradient, sesuaikan jika perlu */
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0));
            z-index: 1; /* Pastikan lapisan di atas gambar */
        }

        /* Judul dan teks pada carousel */
        .carousel-caption {
            position: absolute;
            z-index: 2; /* Pastikan di atas gradient */
            bottom: 20px;
        }

        .carousel-caption h5 {
            font-weight: bold;
            font-size: 18px;
            color: #fff;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption p {
            color: #ddd;
        }

        /* Kontainer untuk konten tambahan */
        .additional-content {
            background : #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 90%;
            max-width: 800px;
            margin: 20px;
        }

        .additional-content h3 {
            color: #333;
            margin-bottom: 10px;
            text-align: center;
        }

        .additional-content p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .card {
            margin: 15px 0;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .icon {
            font-size: 30px;
            color: #007bff;
        }
        .heading-info {
        font-weight: bold; /* Make the text bold */
        color: white; /* Change the text color to white */
        margin: 20px 0; /* Add some margin for spacing */
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
    <h2 class="title">Berita Liga Satu Terbaru</h2>

    <!-- Carousel -->
    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $isActive = true;
            while ($row = mysqli_fetch_assoc($result)) {
                $activeClass = $isActive ? 'active' : '';
                $isActive = false; // Set active class hanya untuk slide pertama
            ?>
                <div class="carousel-item <?= $activeClass; ?>">
                    <a href="berita_detail.php?id=<?= $row['id']; ?>">
                        <img src="img/berita/<?= $row['gambar']; ?>" class="d-block w-100" alt="<?= $row['judul']; ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><?= $row['judul']; ?></h5>
                            <p><?= substr($row['konten'], 0, 100); ?>...</p>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Sebelumnya</span>
        </a>
        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Selanjutnya</span>
        </a>
    </div>

    <!-- Konten Tambahan -->
    <div class="additional-content">
        <h3>Informasi Terbaru</h3>
        <p>Selamat datang di Tiket Liga Satu! Kami sangat senang Anda bergabung dengan kami. Di sini, Anda akan menemukan semua informasi terkini mengenai pertandingan, berita, dan cara pemesanan tiket yang mudah dan cepat.</p>
        <p>Jangan lewatkan kesempatan untuk menjadi bagian dari momen-momen seru di lapangan! Ikuti kami di media sosial dan dapatkan update langsung serta penawaran menarik yang tidak ingin Anda lewatkan.</p>
        <p>Apakah Anda siap untuk mendukung tim favorit Anda? Hubungi kami melalui halaman kontak untuk pertanyaan lebih lanjut. Kami di sini untuk membantu Anda mendapatkan pengalaman terbaik dalam menikmati sepak bola!</p>
    </div>

    <!-- Card Section for Additional Information -->
    <div class="container">
    <h3 class="text-center heading-info">Informasi Lainnya</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="icon fas fa-calendar-alt"></i>
                        <h5 class="card-title">Jadwal Pertandingan</h5>
                        <p class="card-text">Cek jadwal pertandingan terbaru dan jangan lewatkan aksi tim favorit Anda!</p>
                        <a href="index.php" class="btn btn-primary">Lihat Jadwal</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="icon fas fa-ticket-alt"></i>
                        <h5 class="card-title">Beli Tiket</h5>
                        <p class="card-text">Dapatkan tiket Anda dengan mudah dan cepat. Bergabunglah dengan kami di stadion!</p>
                        <a href="index.php" class="btn btn-primary">Beli Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <i class="icon fas fa-users"></i>
                        <h5 class="card-title">Komunitas</h5>
                        <p class="card-text">Bergabunglah dengan komunitas penggemar dan berbagi pengalaman Anda!</p>
                        <a href="kontak.php" class="btn btn-primary">Gabung Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS dan jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>