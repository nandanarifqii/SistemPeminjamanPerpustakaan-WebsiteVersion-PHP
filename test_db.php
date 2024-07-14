<?php
$host = 'localhost:3307'; // Ganti dengan host MySQL Anda
$username = 'root'; // Ganti dengan username MySQL Anda
$database = 'perpustakaan'; // Nama database

// Membuat koneksi ke database
$link = mysqli_connect($host, $username, '', $database);

// Memeriksa apakah koneksi berhasil
if (!$link) {
    die('Koneksi database gagal: ' . mysqli_connect_error());
}

echo 'Koneksi database berhasil!';
mysqli_close($link);
?>
