# 📸 RENTCAM — Modern Camera & Drone Rental System

RENTCAM adalah platform penyewaan kamera dan drone berbasis web yang dirancang dengan antarmuka modern, intuitif, dan responsif. Sistem ini mencakup manajemen inventaris, sistem booking real-time, hingga dashboard analitik untuk pemantauan bisnis yang komprehensif.

## 👥 Tim Pengembang (Kelompok)

| Nama | NIM | Kelas |
|---|---|---|
| Haidar Habibi Al Farisi | 240202862 | 4IKRB |
| Ismi Nur Fadilah | 240202868 | 4IKRB |
| Fauzatul Farhanah | 240202834 | 4IKRB |
| Tyas Nurshika Damaia | 240202887 | 4IKRB |

## 🚀 Tech Stack

- **Backend**: PHP (CodeIgniter 3)
- **Database**: MySQL / MariaDB
- **Frontend**: HTML5, Vanilla CSS3 (Modern UI), JavaScript (ES6)
- **Library & Assets**:
    - **Chart.js**: Untuk visualisasi data pendapatan dan transaksi.
    - **FontAwesome 5**: Untuk ikonografi yang informatif.
    - **SweetAlert2**: Untuk popup konfirmasi dan notifikasi premium.
    - **AOS (Animate On Scroll)**: Untuk animasi transisi halaman yang halus.
    - **Google Fonts**: Poppins (Heading) & Inter (Body).

## 📋 Fitur Utama

- **Pengunjung (Guest)**: Menjelajahi katalog produk yang estetik, melihat spesifikasi detail, dan cek ketersediaan alat.
- **Penyewa (Member)**:
    - Booking online real-time dengan status transaksi transparan.
    - Upload bukti pembayaran langsung dari dashboard (Opsional untuk metode *Cash*).
    - **Manajemen Profil**: Mengubah data diri dan password secara mandiri.
    - Memberi review/rating pada produk yang telah disewa (mendukung multi-review untuk transaksi berbeda).
    - **Manajemen Riwayat**: Menghapus riwayat transaksi penyewaan.
- **Administrator**:
    - Dashboard dengan statistik operasional (Stok rendah, Booking harian).
    - Verifikasi pembayaran dengan sistem review detail.
    - Manajemen produk (CRUD) dengan kategori dinamis.
    - Update status penyewaan (Booking -> Dipinjam -> Kembali).
    - **Manajemen Data**: Menghapus data booking dan data pembayaran beserta pembersihan file foto dari server.
- **Super Admin**:
    - **Analitik Bisnis**: Grafik pendapatan bulanan dan performa produk terlaris.
    - **Personalized Greeting Banner**: Sapaan dinamis berdasarkan waktu (Pagi/Siang/Malam).
    - Manajemen akun (Admin & User) lengkap dengan fitur hapus & ganti status.
    - Laporan Keuangan tahunan dengan filter interaktif.

## ⚙️ Installation & Setup

### 1. Prerequisites
- [XAMPP](https://www.apachefriends.org/index.html) (PHP >= 7.4 & MySQL)
- Web Browser (Chrome/Edge recommended)

### 2. Clone & Setup
```bash
# Clone repository
git clone <repository-url>

# Pindahkan ke folder htdocs
mv rentcam C:\xampp\htdocs\
```

### 3. Database Configuration
1. Buat database baru bernama `rentcam` di phpMyAdmin.
2. Import file `database/rentcam.sql` ke database tersebut.
3. Pastikan konfigurasi di `.env` sudah sesuai:
   ```env
   DB_HOST=localhost
   DB_USER=root
   DB_PASS=
   DB_NAME=rentcam
   ```

### 4. Running the App
Akses melalui browser di: `http://localhost/rentcam`

## 📂 Project Structure

```text
rentcam/
├── application/          # Inti aplikasi (MVC)
│   ├── config/           # Pengaturan database, routes, & autoload
│   ├── controllers/      # Logika aplikasi (Admin, Superadmin, Auth, dll)
│   ├── models/           # Interaksi database
│   └── views/            # Template UI (Premium layouts)
├── assets/               # File statis
│   ├── css/              # Stylesheet global (Modern Design System)
│   ├── js/               # Logika frontend
│   └── uploads/          # Direktori foto produk & bukti bayar
├── .env                  # Konfigurasi environment (Private)
└── index.php             # Entry point aplikasi
```

## 🔐 Credentials (Default)

| Role | Email | Password |
|---|---|---|
| **Super Admin** | `superadmin@gmail.com` | `superadmin123` |
| **Admin** | `admin@gmail.com` | `admin1234` |
| **Member** | `user@gmail.com` | `user123` |

## 🖼️ UI Preview

Berikut adalah tampilan antarmuka utama dari platform RENTCAM:

![Home Page Preview](assets/mockup/image.png)

---

