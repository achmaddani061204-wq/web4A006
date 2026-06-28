# 📚 Sistem Pendataan Buku

> Aplikasi web sederhana untuk mengelola data koleksi buku menggunakan HTML, CSS, PHP Native, dan MySQL.

---

## 👤 Identitas

| | |
|---|---|
| **Nama** | [Nama Mahasiswa] |
| **NIM** | [NIM Mahasiswa] |
| **Judul Aplikasi** | Sistem Pendataan Buku |
| **Mata Kuliah** | Pemrograman Web |

---

## 📝 Deskripsi Singkat

Sistem Pendataan Buku adalah aplikasi web yang memungkinkan pengguna untuk mengelola data koleksi buku secara digital. Aplikasi ini menyediakan fitur lengkap CRUD (Create, Read, Update, Delete) untuk data buku yang meliputi judul, pengarang, penerbit, tahun terbit, dan stok.

---

## ✨ Fitur Aplikasi

- ✅ Menampilkan daftar seluruh buku
- ✅ Tambah buku baru
- ✅ Edit data buku yang sudah ada
- ✅ Hapus data buku
- ✅ Pencarian buku berdasarkan judul atau pengarang
- ✅ Statistik total buku, stok, dan pengarang di halaman beranda

---

## 🗂️ Struktur Database

**Database:** `db_buku`

**Tabel:** `buku`

| Kolom | Tipe | Keterangan |
|---|---|---|
| `id` | INT (PK, AI) | ID unik buku |
| `judul` | VARCHAR(200) | Judul buku |
| `pengarang` | VARCHAR(150) | Nama pengarang |
| `penerbit` | VARCHAR(150) | Nama penerbit |
| `tahun_terbit` | YEAR | Tahun terbit |
| `stok` | INT | Jumlah stok |
| `created_at` | TIMESTAMP | Waktu ditambahkan |

---

## 📁 Struktur File

```
UAS-PWEB-NIM/
├── index.php         # Halaman Beranda
├── daftar.php        # Halaman Daftar Buku (Read)
├── tambah.php        # Halaman Tambah Buku (Create)
├── edit.php          # Halaman Edit Buku (Update)
├── hapus.php         # Proses Hapus Buku (Delete)
├── koneksi.php       # Konfigurasi koneksi database
├── functions.php     # Kumpulan fungsi PHP
├── database.sql      # File SQL database
├── css/
│   └── style.css     # CSS eksternal
└── README.md
```

---

## 🚀 Cara Menjalankan Aplikasi

### Prasyarat
- XAMPP / Laragon / WAMP (PHP 7.4+ dan MySQL)
- Browser (Chrome, Firefox, dll.)

### Langkah-langkah

1. **Clone atau download** repository ini ke folder `htdocs` (XAMPP) atau `www` (Laragon):
   ```
   C:/xampp/htdocs/UAS-PWEB-NIM/
   ```

2. **Import database** melalui phpMyAdmin:
   - Buka `http://localhost/phpmyadmin`
   - Klik **New** → buat database bernama `db_buku`
   - Pilih tab **Import** → pilih file `database.sql` → klik **Go**

3. **Konfigurasi koneksi** (jika perlu):
   - Buka file `koneksi.php`
   - Sesuaikan `DB_USER` dan `DB_PASS` dengan konfigurasi MySQL kamu

4. **Jalankan aplikasi**:
   - Buka browser → akses `http://localhost/UAS-PWEB-NIM/`

---

## 📸 Screenshot Aplikasi

> *(Tambahkan screenshot aplikasi di sini setelah menjalankan)*

| Halaman | Screenshot |
|---|---|
| Beranda | *(screenshot)* |
| Daftar Buku | *(screenshot)* |
| Tambah Buku | *(screenshot)* |
| Edit Buku | *(screenshot)* |

---

## 🤖 Pernyataan Penggunaan GenAI

Proyek ini dikembangkan dengan bantuan **Claude AI (Anthropic)** sebagai alat bantu dalam penulisan kode dan struktur aplikasi. Seluruh logika, pemahaman, dan penjelasan aplikasi tetap merupakan hasil pemahaman mahasiswa yang bersangkutan.

---

## 📜 Lisensi

Dibuat untuk keperluan **Ujian Akhir Semester (UAS)** Mata Kuliah Pemrograman Web.
