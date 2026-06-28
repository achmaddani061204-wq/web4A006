<?php
require_once 'functions.php';

// Validasi ID dari GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: daftar.php');
    exit();
}

$id = (int) $_GET['id'];

// Cek apakah buku ada
$buku = getBukuById($koneksi, $id);

if (!$buku) {
    header('Location: daftar.php');
    exit();
}

// Proses DELETE
$query = "DELETE FROM buku WHERE id = $id";

if (mysqli_query($koneksi, $query)) {
    header('Location: daftar.php?pesan=hapus');
} else {
    header('Location: daftar.php?pesan=error');
}

exit();
?>
