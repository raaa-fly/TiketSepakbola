<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari POST
    $nama_pemesan = htmlspecialchars($_POST['nama']);
    $jumlah_tiket = (int)$_POST['jumlah'];
    $payment_method = htmlspecialchars($_POST['payment_method']);
    $total_harga = $jumlah_tiket * 100000; // Ganti 100000 dengan harga tiket per unit

    // Payment details
    $payment_details = "N/A";
    if ($payment_method === "Transfer Bank") {
        $payment_details = "Bank Account: " . htmlspecialchars($_POST['bank_account']);
    } elseif (in_array($payment_method, ["OVO", "DANA", "Gopay"])) {
        $payment_details = "$payment_method - ID: " . htmlspecialchars($_POST['payment_id']);
    }

    // Generate a random booking code
    $booking_code = mt_rand(100000, 999999); // Generates a random 6-digit number

} else {
    header("Location: display_pemesanan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #007bff, #6610f2); /* Gradient background */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff;
        }

        .ticket-container {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
            border: 3px solid #007bff;
            background-color: #f9f9f9;
            position: relative;
        }

        .ticket-container::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            width: 100%;
            height: 10px;
            background: #007bff;
            border-radius: 5px 5px 0 0;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #007bff;
        }

        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .qr-code img {
            margin-top: 20px;
            border-radius: 8px;
            border: 3px solid #007bff;
        }

        .footer {
            margin-top: 20px;
            margin-bottom: 30px;
            font-size: 14px;
            color: #555;
        }

        .ticket-details {
            font-size: 16px;
            margin: 10px 0;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 6px;
        }

        .ticket-details strong {
            color: #007bff;
        }

        .booking-code {
            margin-top: 20px;
            font-size: 22px;
            font-weight: bold;
            color: #007bff;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 8px;
            border: 2px solid #007bff;
        }

        .back-button {
            margin-top: 90px;
            padding-top: 10px;
            padding-right: 20px;
            padding-bottom: 10px;
            padding-left: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="ticket-container">
    <h1>Detail Pemesanan</h1>
    
    <div class="ticket-details">
        <p><strong>Nama Pemesan:</strong> <?= $nama_pemesan ?></p>
        <p><strong>Jumlah Tiket:</strong> <?= $jumlah_tiket ?> Tiket</p>
        <p><strong>Total Harga:</strong> Rp<?= number_format($total_harga, 2, ',', '.') ?></p>
        <p><strong>Metode Pembayaran:</strong> <?= $payment_method ?></p>
        <p><strong>Detail Pembayaran:</strong> <?= $payment_details ?></p>
    </div>

    <!-- Display the booking code instead of QR Code -->
    <div class="booking-code">
        <h3>Kode Pemesanan</h3>
        <p><?= $booking_code ?></p>
    </div>

    <div class="footer">
        <p>Terima kasih telah melakukan pemesanan tiket!</p>
    </div>

    <!-- Back Button -->
    <a href="pesan.php" class="back-button">Kembali ke Form Pemesanan</a>
</div>

</body>
</html>
