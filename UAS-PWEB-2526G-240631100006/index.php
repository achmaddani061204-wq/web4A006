<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Sistem Pendataan Buku</title>
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
                    <a class="nav-link active" href="index.php"><i class="bi bi-house me-1"></i>Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="daftar.php"><i class="bi bi-list-ul me-1"></i>Daftar Buku</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tambah.php"><i class="bi bi-plus-circle me-1"></i>Tambah Buku</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<div class="hero-section text-white py-6">
    <div class="container text-center">
        <div class="hero-badge mb-3"><i class="bi bi-kanban-fill"></i> Sistem Informasi Buku</div>
        <i class="bi bi-journal-bookmark" style="font-size: 4.5rem;"></i>
        <h1 class="fw-bold mt-4">Pendataan Buku yang Cepat, Modern, dan Informatif</h1>
        <p class="lead mx-auto mb-4" style="max-width: 720px;">Aplikasi ini dirancang untuk kebutuhan perpustakaan dan program studi informatika, dengan antarmuka yang ramah pengguna dan visual yang profesional.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap mb-5">
            <a href="tambah.php" class="btn btn-light btn-lg btn-glow">
                <i class="bi bi-plus-circle me-1"></i> Tambah Buku
            </a>
            <a href="daftar.php" class="btn btn-outline-light btn-lg">
                <i class="bi bi-list-ul me-1"></i> Lihat Daftar
            </a>
        </div>

        <div class="row justify-content-center gx-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <h5><i class="bi bi-speedometer2 text-blue me-2"></i>Responsif</h5>
                    <p>Desain adaptif yang nyaman dipakai di laptop, tablet, dan smartphone.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h5><i class="bi bi-shield-lock text-blue me-2"></i>Aman</h5>
                    <p>Validasi input data dan pemrosesan yang lebih aman untuk operasional sehari-hari.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <h5><i class="bi bi-graph-up-arrow text-blue me-2"></i>Informatif</h5>
                    <p>Statistik ringkas dan indikator stok membantu pengambilan keputusan cepat.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row g-4 mb-5">
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h4><i class="bi bi-person-circle me-2"></i>Informasi Pemilik</h4>
                <p><strong>Nama:</strong> Achmad Dani</p>
                <p><strong>NIM:</strong> 240631100006</p>
                <p><strong>Program Studi:</strong> Pendidikan Informatika</p>
                <p><strong>Judul Aplikasi:</strong> Sistem Pendataan Buku</p>
                <p><strong>Mata Kuliah:</strong> Pemrograman Web</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="dashboard-card">
                <h4><i class="bi bi-layers me-2"></i>Informasi Aplikasi</h4>
                <p><strong>Fitur:</strong> CRUD data buku, pencarian, statistik stok, dan laporan koleksi.</p>
                <p><strong>Database:</strong> db_buku</p>
                <p><strong>Teknologi:</strong> PHP Native, MySQL, Bootstrap, CSS modern.</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<div class="container mt-5">
    <?php
    $totalBuku = countBuku($koneksi);

    // Hitung total stok (percabangan & query langsung)
    $queryStok = mysqli_query($koneksi, "SELECT SUM(stok) as total_stok FROM buku");
    $rowStok = mysqli_fetch_assoc($queryStok);
    $totalStok = $rowStok['total_stok'] ?? 0;

    // Hitung jumlah pengarang unik
    $queryPengarang = mysqli_query($koneksi, "SELECT COUNT(DISTINCT pengarang) as total FROM buku");
    $rowPengarang = mysqli_fetch_assoc($queryPengarang);
    $totalPengarang = $rowPengarang['total'];
    ?>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card stat-card h-100">
                <div class="card-body">
                    <p class="text-muted mb-1"><i class="bi bi-book me-1"></i>Total Judul Buku</p>
                    <h2><?= $totalBuku ?></h2>
                    <small class="text-muted">judul terdaftar</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100" style="border-left: 5px solid #198754;">
                <div class="card-body">
                    <p class="text-muted mb-1"><i class="bi bi-layers me-1"></i>Total Stok</p>
                    <h2 style="color: #ffffff;"><?= $totalStok ?></h2>
                    <small class="text-muted">eksemplar tersedia</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100" style="border-left: 5px solid #fd7e14;">
                <div class="card-body">
                    <p class="text-muted mb-1"><i class="bi bi-people me-1"></i>Total Pengarang</p>
                    <h2 style="color: #ffffff;"><?= $totalPengarang ?></h2>
                    <small class="text-muted">pengarang berbeda</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Buku Terbaru -->
    <div class="card mb-5">
        <div class="card-header bg-primary text-white">
            <i class="bi bi-clock-history me-1"></i> Buku Terbaru Ditambahkan
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Judul</th>
                            <th>Pengarang</th>
                            <th>Penerbit</th>
                            <th>Tahun</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $queryTerbaru = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY created_at DESC LIMIT 5");
                        $no = 1;
                        if (mysqli_num_rows($queryTerbaru) > 0) {
                            while ($row = mysqli_fetch_assoc($queryTerbaru)) {
                                // Percabangan untuk warna stok
                                if ($row['stok'] > 5) {
                                    $badgeColor = 'success';
                                } elseif ($row['stok'] > 0) {
                                    $badgeColor = 'warning';
                                } else {
                                    $badgeColor = 'danger';
                                }
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td><strong>" . htmlspecialchars($row['judul']) . "</strong></td>
                                    <td>" . htmlspecialchars($row['pengarang']) . "</td>
                                    <td>" . htmlspecialchars($row['penerbit']) . "</td>
                                    <td>{$row['tahun_terbit']}</td>
                                    <td><span class='badge bg-{$badgeColor} badge-stok'>{$row['stok']}</span></td>
                                </tr>";
                                $no++;
                            }
                        } else {
                            echo "<tr><td colspan='6' class='text-center text-muted py-3'>Belum ada data buku.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="daftar.php" class="btn btn-primary btn-sm">
                <i class="bi bi-arrow-right me-1"></i>Lihat Semua Buku
            </a>
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
