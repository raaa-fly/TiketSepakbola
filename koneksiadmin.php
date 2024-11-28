<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "loginbola";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
