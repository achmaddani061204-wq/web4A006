<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - Sistem Pendataan Buku</title>
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

<?php
$error = '';

// Validasi ID dari GET
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: daftar.php');
    exit();
}

$id = (int) $_GET['id'];
$buku = getBukuById($koneksi, $id);

// Cek apakah buku ditemukan
if (!$buku) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Buku tidak ditemukan!</div></div>";
    exit();
}

// Proses POST - Update Data (UPDATE)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul     = sanitize($_POST['judul']);
    $pengarang = sanitize($_POST['pengarang']);
    $penerbit  = sanitize($_POST['penerbit']);
    $tahun     = (int) $_POST['tahun_terbit'];
    $stok      = (int) $_POST['stok'];

    // Validasi
    if (empty($judul) || empty($pengarang) || empty($penerbit)) {
        $error = 'Semua field wajib diisi!';
    } elseif ($tahun < 1900 || $tahun > date('Y')) {
        $error = 'Tahun terbit tidak valid!';
    } elseif ($stok < 0) {
        $error = 'Stok tidak boleh negatif!';
    } else {
        $judul     = mysqli_real_escape_string($koneksi, $judul);
        $pengarang = mysqli_real_escape_string($koneksi, $pengarang);
        $penerbit  = mysqli_real_escape_string($koneksi, $penerbit);

        $query = "UPDATE buku SET
                    judul='$judul',
                    pengarang='$pengarang',
                    penerbit='$penerbit',
                    tahun_terbit='$tahun',
                    stok='$stok'
                  WHERE id='$id'";

        if (mysqli_query($koneksi, $query)) {
            header('Location: daftar.php?pesan=edit');
            exit();
        } else {
            $error = 'Gagal memperbarui data: ' . mysqli_error($koneksi);
        }
    }
}

// Gunakan data POST jika ada error, atau data dari DB
$formData = ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST : $buku;
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="daftar.php">Daftar Buku</a></li>
                    <li class="breadcrumb-item active">Edit Buku</li>
                </ol>
            </nav>

            <div class="page-header p-4 mb-4">
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                    <div>
                        <h3 class="page-title mb-1"><i class="bi bi-pencil-square me-2"></i>Edit Buku</h3>
                        <p class="page-subtitle mb-0">Perbarui informasi buku dengan form yang mudah digunakan.</p>
                    </div>
                    <a href="daftar.php" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <div class="info-box">
                <h6>Catatan Edit</h6>
                <p>Periksa kembali data sebelum menyimpan agar koleksi buku tetap akurat dan mudah dilacak.</p>
            </div>

            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Data Buku</h5>
                </div>
                <div class="card-body p-4">
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><i class="bi bi-x-circle me-1"></i><?= $error ?></div>
                    <?php endif; ?>

                    <div class="row gx-4">
                        <div class="col-lg-8">
                            <form method="POST" action="edit.php?id=<?= $id ?>">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Judul Buku <span class="text-danger">*</span></label>
                                    <input type="text" name="judul" class="form-control"
                                        value="<?= htmlspecialchars($formData['judul']) ?>" required>
                                </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pengarang <span class="text-danger">*</span></label>
                            <input type="text" name="pengarang" class="form-control"
                                value="<?= htmlspecialchars($formData['pengarang']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Penerbit <span class="text-danger">*</span></label>
                            <input type="text" name="penerbit" class="form-control"
                                value="<?= htmlspecialchars($formData['penerbit']) ?>" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tahun Terbit <span class="text-danger">*</span></label>
                                <input type="number" name="tahun_terbit" class="form-control"
                                    min="1900" max="<?= date('Y') ?>"
                                    value="<?= $formData['tahun_terbit'] ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Stok <span class="text-danger">*</span></label>
                                <input type="number" name="stok" class="form-control"
                                    min="0"
                                    value="<?= $formData['stok'] ?>" required>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i> Perbarui Data
                            </button>
                            <a href="daftar.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                        </div>
                        <div class="col-lg-4">
                            <div class="info-panel">
                                <h6>Standar Informatika</h6>
                                <p>Data buku yang dikemas rapi membantu pencarian informasi dan laporan statistik. Gunakan nama pengarang dan penerbit yang konsisten untuk mempermudah analisis koleksi.</p>
                                <ul>
                                    <li>Gunakan penulisan nama penulis lengkap.</li>
                                    <li>Masukan tahun terbit sesuai dokumen.</li>
                                    <li>Perbarui stok secara akurat.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
