-- ============================================
-- DATABASE: Sistem Pendataan Buku
-- ============================================

CREATE DATABASE IF NOT EXISTS db_buku;
USE db_buku;

CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    pengarang VARCHAR(150) NOT NULL,
    penerbit VARCHAR(150) NOT NULL,
    tahun_terbit YEAR NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Data awal (minimal 5 record)
INSERT INTO buku (judul, pengarang, penerbit, tahun_terbit, stok) VALUES
('Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 10),
('Bumi Manusia', 'Pramoedya Ananta Toer', 'Hasta Mitra', 1980, 7),
('Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia Pustaka Utama', 2009, 12),
('Perahu Kertas', 'Dee Lestari', 'Bentang Pustaka', 2009, 8),
('Ayah', 'Andrea Hirata', 'Bentang Pustaka', 2015, 5);
