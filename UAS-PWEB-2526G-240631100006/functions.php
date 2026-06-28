<?php
require_once 'koneksi.php';

// Fungsi 1: Ambil semua data buku
function getAllBuku($koneksi) {
    $query = "SELECT * FROM buku ORDER BY created_at DESC";
    $result = mysqli_query($koneksi, $query);
    return $result;
}

// Fungsi 2: Ambil data buku berdasarkan ID
function getBukuById($koneksi, $id) {
    $id = (int) $id;
    $query = "SELECT * FROM buku WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    return mysqli_fetch_assoc($result);
}

// Fungsi 3: Hitung total buku
function countBuku($koneksi) {
    $query = "SELECT COUNT(*) as total FROM buku";
    $result = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}

// Fungsi 4: Sanitasi input
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
