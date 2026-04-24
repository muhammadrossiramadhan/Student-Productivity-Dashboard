<?php
// Ganti dengan kredensial MySQL Anda
$hostname = "localhost";
$username_db = "root";
$password_db = ""; // Kosongkan jika menggunakan XAMPP standar
$database_name = "app_tugas_db"; // Nama database yang Anda buat di SQL atas

// Membuat koneksi
$db = mysqli_connect($hostname, $username_db, $password_db, $database_name);

// Mengecek koneksi
if (mysqli_connect_errno()) {
    die("Gagal terhubung ke database: " . mysqli_connect_error());
}
?>