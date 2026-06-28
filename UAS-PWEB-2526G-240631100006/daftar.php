<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku - Sistem Pendataan Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require_once 'functions.php'; ?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-book-half me-2"></i>SiPendaBuku
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="bi bi-house me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="daftar.php"><i class="bi bi-list-ul me-1"></i>Daftar Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambah.php"><i class="bi bi-plus-circle me-1"></i>Tambah Buku</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <!-- Notifikasi -->
    <?php if (isset($_GET['pesan'])): ?>
        <?php if ($_GET['pesan'] == 'tambah'): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <i class="bi bi-check-circle me-1"></i> Buku berhasil ditambahkan!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['pesan'] == 'edit'): ?>
            <div class="alert alert-info alert-dismissible fade show">
                <i class="bi bi-pencil me-1"></i> Data buku berhasil diperbarui!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif ($_GET['pesan'] == 'hapus'): ?>
            <div class="alert alert-warning alert-dismissible fade show">
                <i class="bi bi-trash me-1"></i> Buku berhasil dihapus!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="page-title"><i class="bi bi-list-ul me-2"></i>Daftar Buku</h3>
            <p class="page-subtitle">Kelola seluruh data koleksi buku</p>
        </div>
        <a href="tambah.php" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i> Tambah Buku
        </a>
    </div>

    <!-- Form Pencarian (GET) -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="daftar.php" class="row g-2 align-items-center">
                <div class="col-md-8">
                    <input type="text" name="cari" class="form-control" placeholder="Cari judul atau pengarang..."
                        value="<?= isset($_GET['cari']) ? htmlspecialchars($_GET['cari']) : '' ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="daftar.php" class="btn btn-outline-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Judul Buku</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Pencarian dengan GET
                        if (isset($_GET['cari']) && $_GET['cari'] !== '') {
                            $cari = sanitize($_GET['cari']);
                            $cari = mysqli_real_escape_string($koneksi, $cari);
                            $query = "SELECT * FROM buku WHERE judul LIKE '%$cari%' OR pengarang LIKE '%$cari%' ORDER BY created_at DESC";
                        } else {
                            $query = "SELECT * FROM buku ORDER BY created_at DESC";
                        }

                        $result = mysqli_query($koneksi, $query);
                        $no = 1;

                        // Perulangan untuk menampilkan data
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // Percabangan stok
                                if ($row['stok'] > 5) {
                                    $badgeColor = 'success';
                                    $labelStok = 'Tersedia';
                                } elseif ($row['stok'] > 0) {
                                    $badgeColor = 'warning';
                                    $labelStok = 'Terbatas';
                                } else {
                                    $badgeColor = 'danger';
                                    $labelStok = 'Habis';
                                }

                                echo "
                                <tr>
                                    <td>{$no}</td>
                                    <td><strong>" . htmlspecialchars($row['judul']) . "</strong></td>
                                    <td>" . htmlspecialchars($row['pengarang']) . "</td>
                                    <td>" . htmlspecialchars($row['penerbit']) . "</td>
                                    <td>{$row['tahun_terbit']}</td>
                                    <td>
                                        <span class='badge bg-{$badgeColor} badge-stok'>{$row['stok']}</span>
                                        <small class='text-muted d-block'>{$labelStok}</small>
                                    </td>
                                    <td>
                                        <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm me-1'>
                                            <i class='bi bi-pencil'></i> Edit
                                        </a>
                                        <a href='hapus.php?id={$row['id']}' class='btn btn-danger btn-sm'
                                           onclick=\"return confirm('Yakin ingin menghapus buku ini?')\">
                                            <i class='bi bi-trash'></i>
                                        </a>
                                    </td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center text-muted py-4'>
                                    <i class='bi bi-inbox fs-3 d-block mb-2'></i>Tidak ada data buku ditemukan.
                                  </td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            Total: <?= mysqli_num_rows($result) ?> buku ditemukan
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="text-center">
    <div class="container">
        <p class="mb-0">&copy; <?= date('Y') ?> Sistem Pendataan Buku | Pemrograman Web</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
