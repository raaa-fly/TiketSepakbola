-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Nov 2024 pada 11.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiket_liga_satu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `berita`
--

CREATE TABLE `berita` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `berita`
--

INSERT INTO `berita` (`id`, `judul`, `konten`, `gambar`, `tanggal`) VALUES
(1, 'Liga Satu: Borneo FC Menang Dramatis', 'Borneo FC berhasil meraih kemenangan dramatis melawan Persija Jakarta dalam laga yang berlangsung di Stadion Segiri. Gol penentu dicetak oleh pemain muda di menit terakhir pertandingan.', 'borneo.jpg', '2024-11-13 18:16:46'),
(2, 'Persebaya Sukses Kembali ke Jalur Kemenangan', 'Setelah beberapa hasil buruk, Persebaya Surabaya akhirnya meraih kemenangan atas Arema FC dengan skor 2-1. Pertandingan berlangsung sengit dan penuh drama.', 'persebaya.jpg', '2024-11-13 18:16:46'),
(3, 'Persib Bandung Tampil Menggigit di Kandang', 'Persib Bandung menunjukkan performa yang sangat baik saat menjamu Bali United di Stadion Gelora Bandung Lautan Api. Mereka menang dengan skor 3-0.', 'persib.jpg', '2024-11-13 18:16:46'),
(4, 'PSM Makassar Raih Poin Penting', 'PSM Makassar berhasil mencuri poin penting saat bertandang ke markas PSIS Semarang. Pertandingan berakhir imbang 1-1.', 'psm.jpg', '2024-11-13 18:16:46'),
(5, 'Dewa United Terus Melaju', 'Dewa United menunjukkan performa yang mengesankan dengan meraih kemenangan ketiga berturut-turut di Liga Satu.', 'dewa united.jpg', '2024-11-13 18:16:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int(11) NOT NULL,
  `id_pertandingan` int(11) DEFAULT NULL,
  `nama_pemesan` varchar(100) NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_harga` decimal(10,2) NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `id_pertandingan`, `nama_pemesan`, `jumlah_tiket`, `total_harga`, `tanggal_pesan`, `payment_method`, `payment_details`) VALUES
(30, 1, 'Bagas', 2, 200000.00, '2024-11-28', 'DANA', 'DANA - ID: 12345678');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertandingan`
--

CREATE TABLE `pertandingan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `tim_home` varchar(50) NOT NULL,
  `tim_away` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pertandingan`
--

INSERT INTO `pertandingan` (`id`, `tanggal`, `waktu`, `tim_home`, `tim_away`, `lokasi`, `harga`, `gambar`) VALUES
(1, '2024-11-15', '15:30:00', 'PSIS Semarang', 'Arema FC', 'Stadion Utama Gelora Bung Karno', 100000.00, 'pertandingan1.jpg'),
(2, '2024-11-16', '18:00:00', 'Persebaya Surabaya', 'Bali United', 'Stadion Gelora Bung Tomo', 120000.00, 'pertandingan2.jpg\r\n\r\n'),
(3, '2024-11-17', '20:00:00', 'PSM Makassar', 'Persib Bandung', 'Stadion Andi Mattalatta', 150000.00, 'pertandingan3.jpg'),
(4, '2024-11-18', '16:00:00', 'Persipura Jayapura', 'PSIS Semarang', 'Stadion Mandala', 130000.00, 'pertandingan4.jpg'),
(5, '2024-11-19', '19:00:00', 'Madura United', 'PSS Sleman', 'Stadion Gelora Ratu Pamelingan', 110000.00, 'pertandingan5.jpg\r\n\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transfer_pemain`
--

CREATE TABLE `transfer_pemain` (
  `id` int(11) NOT NULL,
  `nama_pemain` varchar(100) NOT NULL,
  `klub_asal` varchar(100) NOT NULL,
  `klub_tujuan` varchar(100) NOT NULL,
  `tanggal_transfer` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transfer_pemain`
--

INSERT INTO `transfer_pemain` (`id`, `nama_pemain`, `klub_asal`, `klub_tujuan`, `tanggal_transfer`) VALUES
(1, 'Egy Maulana Vikri', 'Lechia Gdansk', 'Persija Jakarta', '2022-01-10'),
(2, 'Marko Simic', 'Persija Jakarta', 'Persib Bandung', '2022-02-15'),
(3, 'Rafael Silva', 'Bali United', 'Arema FC', '2022-03-20'),
(4, 'Asnawi Mangkualam', 'PSS Sleman', 'Jeonnam Dragons', '2022-04-05'),
(5, 'Witan Sulaeman', 'PSM Makassar', 'FK Radnik Surdulica', '2022-05-12');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertandingan` (`id_pertandingan`);

--
-- Indeks untuk tabel `pertandingan`
--
ALTER TABLE `pertandingan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transfer_pemain`
--
ALTER TABLE `transfer_pemain`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `pertandingan`
--
ALTER TABLE `pertandingan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transfer_pemain`
--
ALTER TABLE `transfer_pemain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`id_pertandingan`) REFERENCES `pertandingan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
