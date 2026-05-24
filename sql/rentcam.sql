-- ============================================================
-- RENTCAM Database Schema
-- Engine: MySQL/MariaDB via XAMPP
-- ============================================================

CREATE DATABASE IF NOT EXISTS rentcam CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE rentcam;

-- ============================================================
-- Table: users
-- ============================================================
CREATE TABLE IF NOT EXISTS users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    nama        VARCHAR(100) NOT NULL,
    email       VARCHAR(100) NOT NULL UNIQUE,
    password    TEXT NOT NULL,
    role        ENUM('user', 'admin', 'superadmin') DEFAULT 'user',
    status      TINYINT(1) DEFAULT 1,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Table: produk
-- ============================================================
CREATE TABLE IF NOT EXISTS produk (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    nama            VARCHAR(100) NOT NULL,
    kategori        ENUM('kamera', 'drone', 'aksesoris') NOT NULL,
    spesifikasi     TEXT,
    harga_per_hari  INT NOT NULL DEFAULT 0,
    stok            INT NOT NULL DEFAULT 0,
    foto            VARCHAR(255) DEFAULT NULL,
    status          ENUM('tersedia', 'tidak_tersedia') DEFAULT 'tersedia',
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Table: booking
-- ============================================================
CREATE TABLE IF NOT EXISTS booking (
    id              INT AUTO_INCREMENT PRIMARY KEY,
    user_id         INT NOT NULL,
    tanggal_mulai   DATE NOT NULL,
    tanggal_selesai DATE NOT NULL,
    total_harga     INT NOT NULL DEFAULT 0,
    status          ENUM('pending', 'confirmed', 'dipinjam', 'kembali', 'batal') DEFAULT 'pending',
    deadline_bayar  DATETIME DEFAULT NULL,
    catatan         TEXT,
    created_at      TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_booking_tanggal ON booking (tanggal_mulai, tanggal_selesai);
CREATE INDEX idx_booking_status ON booking (status);
CREATE INDEX idx_booking_deadline ON booking (deadline_bayar);

-- ============================================================
-- Table: booking_detail
-- ============================================================
CREATE TABLE IF NOT EXISTS booking_detail (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    booking_id  INT NOT NULL,
    produk_id   INT NOT NULL,
    qty         INT NOT NULL DEFAULT 1,
    harga_satuan INT NOT NULL DEFAULT 0,
    FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE CASCADE,
    FOREIGN KEY (produk_id)  REFERENCES produk(id)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE INDEX idx_booking_detail_booking ON booking_detail (booking_id);
CREATE INDEX idx_booking_detail_produk ON booking_detail (produk_id);

-- ============================================================
-- Table: pembayaran
-- ============================================================
CREATE TABLE IF NOT EXISTS pembayaran (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    booking_id  INT NOT NULL,
    metode      VARCHAR(50) DEFAULT 'transfer',
    bukti_bayar VARCHAR(255),
    status      ENUM('pending', 'verified', 'rejected') DEFAULT 'pending',
    catatan_admin TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ============================================================
-- Table: review
-- ============================================================
CREATE TABLE IF NOT EXISTS review (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT NOT NULL,
    produk_id   INT NOT NULL,
    booking_id  INT NOT NULL,
    rating      TINYINT NOT NULL DEFAULT 5,
    komentar    TEXT,
    created_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
    FOREIGN KEY (produk_id) REFERENCES produk(id)  ON DELETE CASCADE,
    FOREIGN KEY (booking_id) REFERENCES booking(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE UNIQUE INDEX uniq_review_user_produk ON review (user_id, produk_id);

-- ============================================================
-- Seeder: Default Users
-- ============================================================
INSERT INTO users (nama, email, password, role) VALUES
('Super Admin', 'superadmin@rentcam.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin'),
('Admin Rentcam', 'admin@rentcam.com',   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Member Demo',  'member@gmail.com',     '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');
-- NOTE: Password untuk semua akun di atas adalah "password"

-- ============================================================
-- Seeder: Sample Products
-- ============================================================
INSERT INTO produk (nama, kategori, spesifikasi, harga_per_hari, stok, status) VALUES
('Canon EOS 80D', 'kamera', '24.2 MP, APS-C, WiFi, Video 1080p, Kit Lens 18-55mm', 250000, 3, 'tersedia'),
('Sony A7 III', 'kamera', '24.2 MP Full Frame, 4K Video, IBIS, 28-70mm Kit', 450000, 2, 'tersedia'),
('DJI Mavic Air 2', 'drone', '48MP, 4K/60fps, 34 min flight, OcuSync 2.0, 10km range', 600000, 2, 'tersedia'),
('DJI Mini 3 Pro', 'drone', '48MP, 4K/60fps, Tri-directional Sensing, 34 min', 500000, 1, 'tersedia'),
('GoPro Hero 11', 'aksesoris', '5.3K, HyperSmooth 5.0, Waterproof 10m, WiFi/BT', 150000, 5, 'tersedia'),
('Tripod Manfrotto', 'aksesoris', 'Max Height 177cm, Max Load 8kg, Aluminium', 50000, 5, 'tersedia');
