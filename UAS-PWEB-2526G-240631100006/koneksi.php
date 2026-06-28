<?php
// Konfigurasi koneksi database
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'db_buku');

$koneksi = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$koneksi) {
    die("<div class='alert alert-danger m-3'>Koneksi database gagal: " . mysqli_connect_error() . "</div>");
}

mysqli_set_charset($koneksi, 'utf8');
?>
