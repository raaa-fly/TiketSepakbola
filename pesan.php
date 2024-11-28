<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_pertandingan = $_GET['id'];
    $query = "SELECT * FROM pertandingan WHERE id = $id_pertandingan";
    $result = mysqli_query($conn, $query);
    $pertandingan = mysqli_fetch_assoc($result);
}

$pemesanan_success = false; 
$detail_pemesanan = []; 

if (isset($_POST['pesan'])) {
    $nama_pemesan = $_POST['nama'];
    $jumlah_tiket = $_POST['jumlah'];
    $total_harga = $jumlah_tiket * $pertandingan['harga'];
    $tanggal_pesan = date("Y-m-d");
    $payment_method = $_POST['payment_method']; 

    if ($payment_method == "Transfer Bank") {
        $bank_account = $_POST['bank_account'];
        $payment_details = "Bank Transfer - Account: $bank_account";
    } elseif (in_array($payment_method, ["OVO", "DANA", "Gopay"])) {
        $payment_id = $_POST['payment_id'];
        $payment_details = "$payment_method - ID: $payment_id";
    } else {
        $payment_details = "No payment details provided";
    }

    $query_pesan = "INSERT INTO pemesanan (id_pertandingan, nama_pemesan, jumlah_tiket, total_harga, tanggal_pesan, payment_method, payment_details) 
                    VALUES ('$id_pertandingan', '$nama_pemesan', '$jumlah_tiket', '$total_harga', '$tanggal_pesan', '$payment_method', '$payment_details')";

    if (mysqli_query($conn, $query_pesan)) {
        $pemesanan_success = true;
        $detail_pemesanan = [
            'nama_pemesan' => $nama_pemesan,
            'jumlah_tiket' => $jumlah_tiket,
            'total_harga' => $total_harga,
            'tanggal_pesan' => $tanggal_pesan,
            'payment_method' => $payment_method,
            'payment_details' => $payment_details
        ];
    } else {
        $message = "Gagal melakukan pemesanan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pemesanan Tiket - <?= $pertandingan['tim_home'] ?> vs <?= $pertandingan['tim_away'] ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
        }

        .message {
            background-color: #e7f3fe;
            color: #31708f;
            border: 1px solid #bcdff1;
            padding: 10px;
            margin-bottom: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        .payment-method-form {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.0/JsBarcode.all.min.js"></script>
    <script>
        function showPaymentForm() {
            var paymentMethod = document.getElementById('payment_method').value;
            var bankForm = document.getElementById('bank_form');
            var eWalletForm = document.getElementById ('ewallet_form');
            
            bankForm.style.display = 'none';
            eWalletForm.style.display = 'none';

            if (paymentMethod == 'Transfer Bank') {
                bankForm.style.display = 'block';
            } else if (paymentMethod == 'OVO' || paymentMethod == 'DANA' || paymentMethod == 'Gopay') {
                eWalletForm.style.display = 'block';
            }
        }
    </script>
</head>
<body>
    <h1>Pemesanan Tiket: <?= $pertandingan['tim_home'] ?> vs <?= $pertandingan['tim_away'] ?></h1>

    <?php if (isset($message)) { ?>
        <div class="message"><?= $message ?></div>
    <?php } ?>

    <?php if ($pemesanan_success) { ?>
        <div class="message">
            <h2>Detail Pemesanan</h2>
            <p><strong>Nama Pemesan:</strong> <?= $detail_pemesanan['nama_pemesan'] ?></p>
            <p><strong>Jumlah Tiket:</strong> <?= $detail_pemesanan['jumlah_tiket'] ?></p>
            <p><strong>Total Harga:</strong> Rp<?= number_format($detail_pemesanan['total_harga'], 2, ',', '.') ?></p>
            <p><strong>Tanggal Pesan:</strong> <?= $detail_pemesanan['tanggal_pesan'] ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= $detail_pemesanan['payment_method'] ?></p>
            <p><strong>Detail Pembayaran:</strong> <?= $detail_pemesanan['payment_details'] ?></p>
            
            <h3>Barcode Pemesanan</h3>
            <svg id="barcode"></svg>
        </div>

        <script>
            var randomString = '<?= uniqid() ?>'; // Generates a unique ID
            JsBarcode("#barcode", randomString, {
                format: "CODE128",
                lineColor: "#0aa",
                width: 4,
                height: 40,
                displayValue: true
            });
        </script>
    <?php } else { ?>
        <form method="post">
            <label for="nama">Nama Pemesan:</label>
            <input type="text" name="nama" id="nama" required><br>

            <label for="jumlah">Jumlah Tiket:</label>
            <input type="number" name="jumlah" id="jumlah" required><br>

            <label for="total_harga">Total Harga: Rp<?= number_format($pertandingan['harga'], 2, ',', '.') ?> / Tiket</label><br>

            <label for="payment_method">Metode Pembayaran:</label>
            <select name="payment_method" id="payment_method" required onchange="showPaymentForm()">
                <option value="Transfer Bank">Transfer Bank</option>
                <option value="OVO">OVO</option>
                <option value="DANA">DANA</option>
                <option value="Gopay">Gopay</option>
            </select><br>

            <div id="bank_form" class="payment-method-form" style="display:none;">
                <label for="bank_account">Nomor Rekening Bank:</label>
                <input type="text" name="bank_account" id="bank_account">
            </div>

            <div id="ewallet_form" class="payment-method-form" style="display:none;">
                <label for="payment_id">ID Pembayaran:</label>
                <input type="text" name="payment_id" id="payment_id">
            </div>

            <button type="submit" name="pesan">Pesan Tiket</button>
        </form>
    <?php } ?>
</body>
</html>