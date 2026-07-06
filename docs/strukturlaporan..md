# LAPORAN TUGAS AKHIR
# PENGEMBANGAN SISTEM INFORMASI PENYEWAAN KAMERA DAN DRONE (RENTCAM) BERBASIS WEB MENGGUNAKAN FRAMEWORK CODEIGNITER 3

**Disusun Oleh:**
- Haidar Habibi Al Farisi (240202862)
- Ismi Nur Fadilah (240202868)
- Fauzatul Farhanah (240202834)
- Tyas Nurshika Damaia (240202887)

**PROGRAM STUDI TEKNIK INFORMATIKA**
**UNIVERSITAS [NAMA KAMPUS ANDA]**
**2024**

---

## KATA PENGANTAR

Puji syukur kami panjatkan kehadirat Allah SWT atas rahmat dan hidayah-Nya sehingga kami dapat menyelesaikan laporan pengembangan sistem informasi **"RENTCAM — Modern Camera & Drone Rental System"**.

Sistem ini dirancang khusus untuk mendigitalisasi seluruh ekosistem penyewaan alat fotografi di workshop RENTCAM, mulai dari manajemen inventaris hingga dashboard analitik keuangan. Kami mengucapkan terima kasih kepada Bapak/Ibu Dosen Pembimbing Mata Kuliah Pengembangan Web, serta rekan-rekan tim 4IKRB yang telah berkontribusi dalam pengkodean dan penyusunan dokumen ini.

Semoga laporan ini menjadi bukti nyata penerapan ilmu rekayasa perangkat lunak dalam solusi bisnis lokal.

Penulis,
Mei 2024

---

## DAFTAR ISI

1. [BAB I PENDAHULUAN](#bab-i-pendahuluan)
   - 1.1 Latar Belakang
   - 1.2 Rumusan Masalah
   - 1.3 Batasan Masalah
   - 1.4 Tujuan
2. [BAB II LANDASAN TEORI](#bab-ii-landasan-teori)
   - 2.1 Framework CodeIgniter 3
   - 2.2 Arsitektur Model-View-Controller (MVC)
   - 2.3 Manajemen Basis Data MySQL
   - 2.4 Library Frontend (AOS, SweetAlert2, Chart.js)
3. [BAB III METODOLOGI](#bab-iii-metodologi)
   - 3.1 Prosedur Penelitian (Waterfall)
   - 3.2 Analisis Sistem & Alur Bisnis
   - 3.3 Perancangan Database (ERD)
4. [BAB IV HASIL DAN PEMBAHASAN](#bab-iv-hasil-dan-pembahasan)
   - 4.1 Struktur Direktori Proyek
   - 4.2 Implementasi Backend (Controller & Model)
   - 4.3 Sistem Autentikasi & Role-Based Access Control
   - 4.4 Implementasi Frontend (Responsive UI)
   - 4.5 Fitur Unggulan: Booking Atomik & Analytics
5. [BAB V PENUTUP](#bab-v-penutup)
   - 5.1 Kesimpulan
   - 5.2 Saran Pengembangan
6. [DAFTAR PUSTAKA](#daftar-pustaka)
7. [LAMPIRAN](#lampiran)

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang

Workshop RENTCAM menghadapi tantangan operasional serius akibat lonjakan permintaan sewa kamera DSLR, Mirrorless, dan Drone. Sistem manual yang selama ini digunakan melalui WhatsApp sering menyebabkan masalah kritis: data booking bertumpuk, bukti transfer terselip, ketidakpastian stok bagi pelanggan, dan tidak ada laporan keuangan terstruktur.

Kebutuhan spesifik yang teridentifikasi antara lain:
- **Konflik stok** (*over-booking*): dua pelanggan memesan item yang sama pada tanggal yang bersamaan.
- **Verifikasi pembayaran manual**: admin harus mengecek rekening koran secara manual.
- **Tidak ada data analitik**: pengelola tidak tahu produk mana yang paling laris atau tren pendapatan bulanan.

Diperlukan sebuah platform berbasis web yang menyediakan **transparansi stok secara real-time**, alur transaksi yang terverifikasi, dan laporan keuangan otomatis.

### 1.2 Rumusan Masalah

1. Bagaimana mencegah *over-booking* dengan validasi stok yang presisi secara *real-time*, bahkan pada kondisi transaksi bersamaan (*race condition*)?
2. Bagaimana membangun alur verifikasi bukti pembayaran yang efisien melalui panel Admin, dengan status yang transparan bagi pelanggan?
3. Bagaimana menyajikan tren pendapatan bulanan, produk terlaris, dan ringkasan operasional untuk mendukung pengambilan keputusan bisnis oleh Super Admin?
4. Bagaimana mengimplementasikan sistem *role-based access control* (RBAC) yang aman untuk tiga tingkat pengguna: Member, Admin, dan Super Admin?

### 1.3 Batasan Masalah

1. Sistem dikembangkan menggunakan PHP framework **CodeIgniter 3** dan basis data **MySQL** via XAMPP.
2. Pembayaran menggunakan metode **transfer manual** dengan fitur unggah (*upload*) bukti bayar — belum terintegrasi dengan *payment gateway* otomatis.
3. Kategori produk dibatasi pada tiga jenis: **Kamera**, **Drone**, dan **Aksesoris** (tripod, action cam, dll.).
4. Setiap transaksi booking hanya bisa mencakup **satu jenis produk** dengan jumlah (*qty*) yang dapat disesuaikan.
5. Sistem berjalan di lingkungan server lokal (XAMPP) dan diakses melalui browser standar.

### 1.4 Tujuan

Membangun aplikasi RENTCAM yang mampu menangani siklus sewa secara menyeluruh:
1. **Pendaftaran & Autentikasi**: Member mendaftar, login, dan mendapat akses sesuai role.
2. **Pemilihan & Booking**: Member memilih produk berdasarkan ketersediaan stok pada rentang tanggal tertentu.
3. **Pembayaran**: Member mengunggah bukti transfer; Admin memverifikasi atau menolak.
4. **Manajemen Inventaris**: Admin mengelola data produk (CRUD) beserta stok aktual.
5. **Pelaporan Keuangan**: Super Admin memantau pendapatan bulanan, produk terlaris, dan ekspor data ke CSV.

---

## BAB II LANDASAN TEORI

### 2.1 Framework CodeIgniter 3

CodeIgniter 3 (CI3) dipilih sebagai basis pengembangan karena memiliki karakteristik yang ideal untuk proyek skala menengah:
- **Small Footprint**: Ukuran framework yang kecil (~2 MB) meminimalkan overhead server.
- **Active Record Pattern**: Memungkinkan penulisan query database yang aman dari *SQL Injection* tanpa menulis SQL mentah. Contoh dalam `Booking_model.php`: `$this->db->where_in('booking.status', ['pending', 'confirmed', 'dipinjam'])`.
- **Library Bawaan**: *Form Validation*, *Session Management*, dan *File Uploading* tersedia langsung tanpa dependensi eksternal.
- **URL Routing**: Pola URI `controller/method/parameter` langsung terpetakan ke kelas PHP.

### 2.2 Arsitektur Model-View-Controller (MVC)

Sistem RENTCAM menerapkan MVC secara konsisten, dengan lapisan tambahan `core/MY_Controller.php` untuk *middleware* RBAC:

- **Model** (`application/models/`): Mengelola seluruh logika data dan query ke database.
  - `Booking_model.php` — Menangani seluruh siklus hidup booking.
  - `Produk_model.php` — CRUD produk dan pengecekan stok.
  - `Pembayaran_model.php` — Manajemen status pembayaran.
  - `Laporan_model.php` — Agregasi data untuk laporan keuangan.
  - `User_model.php` — Autentikasi dan manajemen akun pengguna.
  - `Review_model.php` — Penyimpanan dan pengambilan ulasan produk.
  - `Booking_detail_model.php` — Detail item per transaksi booking.

- **View** (`application/views/`): Menangani presentasi HTML ke pengguna, terorganisir per segmen:
  - `views/auth/` — Halaman login dan registrasi.
  - `views/user/` — Landing page, katalog produk, form booking, upload pembayaran, riwayat.
  - `views/admin/` — Panel manajemen booking, produk, verifikasi pembayaran, user.
  - `views/superadmin/` — Dashboard analitik dan laporan keuangan.
  - `views/templates/` — Layout pembungkus (header, footer, sidebar) yang di-include oleh setiap view.

- **Controller** (`application/controllers/`): Memproses *request* HTTP dan mengkoordinasikan Model & View.
  - `Auth.php` — Login, Registrasi, Logout.
  - `Booking.php` — Form booking, riwayat, hapus booking.
  - `Pembayaran.php` — Upload bukti bayar, cek status.
  - `Produk.php` — Halaman katalog publik & detail produk.
  - `Review.php` — Pengiriman ulasan produk.
  - `Profile.php` — Manajemen profil member.
  - `Admin/Booking.php`, `Admin/Produk.php`, `Admin/Pembayaran.php`, `Admin/User.php` — Panel Admin.
  - `Superadmin/Dashboard.php`, `Superadmin/Laporan.php` — Panel Super Admin.

### 2.3 Manajemen Basis Data MySQL

Database `rentcam` dirancang dengan **6 tabel inti** yang saling berelasi menggunakan *foreign key* untuk menjaga integritas referensial:

| Tabel | Fungsi |
|---|---|
| `users` | Menyimpan akun pengguna dengan kolom `role` ENUM: `user`, `admin`, `superadmin` |
| `produk` | Inventaris alat sewa dengan kolom `kategori` ENUM: `kamera`, `drone`, `aksesoris` |
| `booking` | Header transaksi sewa dengan kolom `status` ENUM: `pending`, `confirmed`, `dipinjam`, `kembali`, `batal` |
| `booking_detail` | Rincian item per booking (mendukung multi-item di masa depan) |
| `pembayaran` | Bukti bayar dengan kolom `status` ENUM: `pending`, `verified`, `rejected` |
| `review` | Ulasan & rating produk dari penyewa yang telah mengembalikan alat |

*Indexing* diterapkan pada kolom-kolom yang sering digunakan dalam query filter:
```sql
CREATE INDEX idx_booking_tanggal  ON booking (tanggal_mulai, tanggal_selesai);
CREATE INDEX idx_booking_status   ON booking (status);
CREATE INDEX idx_booking_deadline ON booking (deadline_bayar);
```

### 2.4 Library Frontend (AOS, SweetAlert2, Chart.js)

Untuk menciptakan pengalaman pengguna yang premium, sistem mengintegrasikan beberapa library modern:

- **AOS (Animate On Scroll)**: Memberikan efek *fade-in*, *slide-up*, dan animasi scroll dinamis pada halaman *landing page* dan katalog produk. Dikonfigurasikan di halaman utama `views/user/home.php`.
- **SweetAlert2**: Menggantikan `alert()` bawaan browser dengan dialog modal yang elegan dan dapat dikustomisasi. Digunakan untuk konfirmasi tindakan kritis seperti pembatalan booking dan penghapusan data.
- **Chart.js**: Library berbasis `<canvas>` untuk merender grafik interaktif pada dashboard Super Admin. Mengonsumsi data dari `Laporan_model::get_pendapatan_bulanan()` untuk menampilkan visualisasi pendapatan per bulan.

---

## BAB III METODOLOGI

### 3.1 Prosedur Penelitian (Waterfall)

Pengembangan sistem RENTCAM mengikuti **metode Waterfall** yang mencakup tahapan linear dan terstruktur:

1. **Requirement Analysis**: Mengidentifikasi kebutuhan fungsional: booking real-time, upload bukti bayar, dashboard analitik, dan RBAC tiga tingkat. Mengidentifikasi kebutuhan non-fungsional: keamanan dari *SQL Injection*, validasi *race condition*, dan tampilan responsif.
2. **System Design**: Merancang skema database (ERD), alur sistem (Flowchart), hierarki controller (RBAC), dan prototipe antarmuka.
3. **Implementation**: Penulisan kode PHP dengan CI3, HTML5, dan CSS3. Implementasi dilakukan modul per modul sesuai prioritas (Autentikasi → Produk → Booking → Pembayaran → Laporan).
4. **Integration & Testing**: Pengujian integrasi antar modul, pengujian fitur oleh tim pengembang (registrasi, booking, verifikasi pembayaran), dan validasi tampilan di berbagai *browser*.
5. **Operation & Maintenance**: Penyebaran sistem ke lingkungan server lokal (XAMPP dengan Apache + MySQL) dan penyusunan dokumentasi teknis.

### 3.2 Analisis Sistem & Alur Bisnis

**Alur Booking (Member):**
```
Landing Page → Katalog Produk → Detail Produk
  → Form Booking (tanggal, qty, KTP)
  → Validasi Stok Real-time (Booking_model::get_available_stok)
  → Booking Tersimpan (status: pending)
  → Upload Bukti Pembayaran (Pembayaran_model::create)
  → Menunggu Verifikasi Admin
  → Status Diperbarui (confirmed / rejected)
  → Alat Dipinjam (dipinjam) → Dikembalikan (kembali)
  → Kirim Ulasan & Rating
```

**Alur Verifikasi (Admin):**
```
Panel Admin → Daftar Pembayaran Pending
  → Lihat Bukti Bayar → Verifikasi / Tolak
  → Status Booking Diperbarui
  → Manajemen Booking (ubah status: dipinjam, kembali)
```

**Alur Auto-Cancel (Sistem):**
Setiap kali `Booking_model::get_all()` atau `get_by_user()` dipanggil, fungsi `expire_pending()` dieksekusi otomatis. Booking berstatus `pending` yang melewati kolom `deadline_bayar` (default: +1 hari dari waktu booking) akan otomatis berubah menjadi `batal`.

### 3.3 Perancangan Database (ERD)

Entity Relationship Diagram (ERD) dirancang untuk meminimalkan redundansi data. Relasi lengkap antar entitas:

| Relasi | Tipe | Keterangan |
|---|---|---|
| `users` → `booking` | One-to-Many | Satu user bisa memiliki banyak riwayat booking |
| `booking` → `booking_detail` | One-to-Many | Satu booking bisa memiliki banyak item produk |
| `produk` → `booking_detail` | One-to-Many | Satu produk bisa muncul di banyak booking |
| `booking` → `pembayaran` | One-to-One | Satu booking memiliki satu data pembayaran |
| `produk` → `review` | One-to-Many | Satu produk bisa menerima banyak ulasan |
| `users` → `review` | One-to-Many | Satu user bisa memberi ulasan di banyak produk |

Kendala *unique* diterapkan untuk mencegah duplikasi ulasan:
```sql
CREATE UNIQUE INDEX uniq_review_user_produk ON review (user_id, produk_id);
```

Kolom `deleted_at` pada tabel `booking` mengimplementasikan **Soft Delete** — data tidak benar-benar dihapus dari database, melainkan hanya diberi *timestamp* penghapusan.

---

## BAB IV HASIL DAN PEMBAHASAN

### 4.1 Struktur Direktori Proyek

```
rentcam/
├── application/
│   ├── config/          # database.php, routes.php, config.php
│   ├── controllers/
│   │   ├── Auth.php         # Login, Register, Logout
│   │   ├── Booking.php      # Booking oleh Member
│   │   ├── Pembayaran.php   # Upload & cek status pembayaran
│   │   ├── Produk.php       # Katalog publik
│   │   ├── Review.php       # Ulasan produk
│   │   ├── Profile.php      # Profil Member
│   │   ├── Home.php         # Landing Page
│   │   ├── Admin/           # Panel Admin (Booking, Produk, Pembayaran, User)
│   │   └── Superadmin/      # Panel Super Admin (Dashboard, Laporan)
│   ├── core/
│   │   └── MY_Controller.php  # Base RBAC: Guest, User, Admin, Superadmin Controller
│   ├── helpers/
│   │   └── export_helper.php  # Helper untuk ekspor CSV/Excel
│   ├── libraries/
│   │   └── Upload_config.php  # Library upload KTP & bukti bayar
│   ├── models/
│   │   ├── Booking_model.php
│   │   ├── Booking_detail_model.php
│   │   ├── Pembayaran_model.php
│   │   ├── Produk_model.php
│   │   ├── Laporan_model.php
│   │   ├── Review_model.php
│   │   └── User_model.php
│   └── views/
│       ├── auth/            # login.php, register.php
│       ├── user/            # home, produk, booking, pembayaran, review
│       ├── admin/           # panel admin
│       ├── superadmin/      # dashboard & laporan
│       ├── profile/         # halaman profil
│       └── templates/       # layout pembungkus
├── assets/                  # CSS, JS, gambar
├── sql/
│   └── rentcam.sql          # Skema & seeder database
└── .htaccess                # Konfigurasi URL Rewriting (menghilangkan index.php)
```

### 4.2 Implementasi Backend (Controller & Model)

#### 4.2.1 Model: Booking_model.php

Model inti yang menangani seluruh logika transaksi dengan fitur kunci:

**a) Atomic Booking Transaction (`place_booking`)**

Fungsi ini menggunakan *database transaction* CI3 (`trans_start` / `trans_complete`) dikombinasikan dengan **Pessimistic Locking** (`SELECT ... FOR UPDATE`) untuk mencegah *race condition*:

```php
// Mengunci baris produk agar tidak ada transaksi lain yang mengubahnya
$produk = $this->db->query(
    "SELECT * FROM produk WHERE id = ? FOR UPDATE", [$produk_id]
)->row();

// Re-validasi stok di dalam transaksi (setelah lock berhasil)
$reserved = $this->get_reserved_qty($produk_id, $mulai, $selesai);
$stok_tersedia = max(0, $produk->stok - $reserved);

if ($detail_data['qty'] > $stok_tersedia) {
    $this->db->trans_rollback();
    return false; // Gagal: stok tidak cukup
}
```

**b) Kalkulasi Stok Tersedia (`get_available_stok` & `get_reserved_qty`)**

Sistem tidak hanya mengecek kolom `stok` di tabel `produk`, melainkan menghitung stok yang **sedang direservasi** oleh booking aktif pada rentang tanggal yang sama:

```php
// Hitung qty produk yang sudah terbooking pada rentang tanggal tertentu
$this->db->where_in('booking.status', ['pending', 'confirmed', 'dipinjam']);
$this->db->where('booking.tanggal_mulai <', $tanggal_selesai);
$this->db->where('booking.tanggal_selesai >', $tanggal_mulai);
// Hasil: stok_produk - reserved_qty = stok_tersedia_aktual
```

**c) Auto-Cancel (`expire_pending`)**

Dipanggil otomatis sebelum setiap operasi baca (*get_all*, *get_by_user*, *get_by_id*). Fungsi ini mengambil semua booking `pending` yang melewati `deadline_bayar` dan langsung mengubah statusnya menjadi `batal`, sekaligus menolak data pembayaran yang terkait.

#### 4.2.2 Model: Laporan_model.php

Menyediakan data agregat untuk dashboard Super Admin:

| Fungsi | Deskripsi |
|---|---|
| `get_pendapatan_bulanan($tahun)` | SUM total_harga dari pembayaran yang `verified`, dikelompokkan per bulan |
| `get_produk_terlaris($limit)` | SUM qty booking per produk untuk status `confirmed`, `dipinjam`, `kembali` |
| `get_booking_harian($days)` | COUNT booking per hari untuk 14 hari terakhir |
| `get_stok_rendah($limit, $threshold)` | Daftar produk dengan stok ≤ threshold (default: 3) |
| `get_summary()` | Ringkasan: total booking, user, produk, dan pendapatan kumulatif |

#### 4.2.3 Controller: Pembayaran.php

Alur upload pembayaran yang robust dengan serangkaian validasi berlapis sebelum menyimpan data:

1. **Cek kedaluwarsa**: Jika `deadline_bayar` sudah lewat, booking otomatis dibatalkan.
2. **Cek status booking**: Upload hanya diizinkan jika status booking masih `pending`.
3. **Cek duplikasi**: Jika sudah ada pembayaran sebelumnya (status `rejected`), data di-*update*, bukan di-*insert* ulang.
4. **Upload file**: Menggunakan library `Upload_config` untuk memvalidasi tipe dan ukuran file bukti bayar.

### 4.3 Sistem Autentikasi & Role-Based Access Control

Sistem RBAC diimplementasikan melalui hierarki kelas pada `application/core/MY_Controller.php`:

```
CI_Controller (Framework)
    └── MY_Controller       — Base controller (semua halaman)
        ├── Guest_Controller    — Halaman publik (Auth, Home)
        │                         Jika sudah login → redirect ke dashboard role
        ├── User_Controller     — Halaman Member (Booking, Pembayaran, Review)
        │                         Wajib login + role = 'user'
        ├── Admin_Controller    — Panel Admin (Booking, Produk, Pembayaran, User)
        │                         Wajib login + role = 'admin' atau 'superadmin'
        └── Superadmin_Controller — Panel Super Admin (Dashboard, Laporan)
                                    Wajib login + role = 'superadmin'
```

**Tiga Level Akses:**

| Role | Akses |
|---|---|
| `user` (Member) | Katalog produk, form booking, upload pembayaran, riwayat, ulasan, profil |
| `admin` | Semua akses member + manajemen booking, produk, verifikasi pembayaran, data user |
| `superadmin` | Semua akses admin + dashboard analitik, laporan keuangan, ekspor CSV, manajemen admin |

**Proses Login (`Auth.php`):**

1. Validasi form (email valid, password tidak kosong).
2. `User_model::get_by_email()` — mengambil data user dari database.
3. `User_model::verify_password()` — memverifikasi password menggunakan `password_verify()` (bcrypt).
4. Cek `status` user (aktif/nonaktif).
5. Simpan `user_id`, `nama`, `email`, `role` ke dalam *session*.
6. Redirect ke dashboard sesuai role via fungsi helper `redirect_by_role()`.

### 4.4 Implementasi Frontend (Responsive UI)

Tampilan dibangun dengan **HTML5** dan **Vanilla CSS3** murni tanpa framework CSS eksternal, dengan pendekatan *Mobile First*:

- **Landing Page** (`views/user/home.php`): Menampilkan hero section, katalog produk unggulan, dan cara pemesanan. Dilengkapi animasi AOS untuk efek scroll yang dinamis.
- **Katalog Produk**: Layout grid responsif yang menampilkan kartu produk dengan foto, kategori, harga per hari, dan status stok.
- **Form Booking** (`views/user/booking/form.php`): Formulir pemilihan tanggal mulai/selesai, jumlah unit, nomor HP, alamat, dan upload foto KTP.
- **Dashboard Admin**: Layout dua kolom dengan sidebar navigasi, tabel manajemen booking dengan filter status, dan tombol aksi cepat (verifikasi, ubah status).
- **Dashboard Super Admin**: Kartu ringkasan (total booking, user, produk, pendapatan), grafik Chart.js pendapatan bulanan, tabel produk terlaris, dan tombol ekspor CSV.

### 4.5 Fitur Unggulan: Booking Atomik & Analytics

#### a) Real-time Booking dengan Pencegahan Race Condition
Sistem melakukan **dua kali validasi stok**:
- **Validasi I** (di Controller): Ditampilkan ke user sebagai *feedback* form awal.
- **Validasi II** (di dalam database transaction dengan `FOR UPDATE` lock): Memastikan data yang benar-benar tersimpan ke database sudah pasti valid, bahkan jika ada dua user yang booking secara bersamaan.

Kalkulasi biaya sewa dilakukan otomatis:
```
Total Harga = harga_per_hari × qty × durasi_sewa (dalam hari)
```

#### b) Business Intelligence (Analytics) — Panel Super Admin
Dashboard laporan (`Superadmin/Laporan.php`) mengagregasi data dari beberapa tabel:
- **Pendapatan Bulanan**: Dari `Laporan_model::get_pendapatan_bulanan($tahun)` — hanya menghitung pembayaran berstatus `verified`.
- **Produk Terlaris**: Dari `Laporan_model::get_produk_terlaris(10)` — diurutkan berdasarkan total unit yang berhasil disewa.
- **Ekspor CSV**: Fungsi `Superadmin/Laporan::export()` menggunakan `export_helper.php` untuk menghasilkan file CSV berisi rekapitulasi seluruh transaksi dengan nama file otomatis: `Laporan_Keuangan_RENTCAM_YYYY-MM-DD.csv`.

#### c) Sistem Ulasan & Feedback Loop
Tabel `review` memiliki *unique constraint* `(user_id, produk_id)` sehingga satu pengguna hanya dapat memberikan satu ulasan per produk. Rating berbentuk bintang (1–5) disimpan di kolom `rating TINYINT`, dan ulasan hanya dapat diberikan oleh pengguna yang telah menyelesaikan transaksi sewa (*status booking: kembali*).

---

## BAB V PENUTUP

### 5.1 Kesimpulan

Sistem RENTCAM telah berhasil menjawab seluruh tantangan operasional yang diidentifikasi pada BAB I:

1. **Masalah *Over-Booking* Terpecahkan**: Implementasi *Pessimistic Locking* (`SELECT ... FOR UPDATE`) pada fungsi `Booking_model::place_booking()` memastikan validasi stok bersifat *atomic*, sehingga tidak ada dua transaksi yang dapat mereservasi unit yang sama secara bersamaan.

2. **Alur Pembayaran Terstruktur**: Fitur upload bukti bayar beserta mekanisme verifikasi oleh Admin menggantikan proses WhatsApp yang tidak terstruktur. Sistem *auto-cancel* via `expire_pending()` memastikan stok tidak terkunci secara permanen oleh booking yang tidak dibayar.

3. **Pengambilan Keputusan Berbasis Data**: Dashboard Super Admin dengan `Chart.js` dan `Laporan_model.php` menyediakan visualisasi pendapatan bulanan dan analisis produk terlaris yang sebelumnya tidak tersedia.

4. **Keamanan Bertingkat**: Hierarki `MY_Controller → User/Admin/Superadmin_Controller` memastikan setiap endpoint terlindungi sesuai hak akses, dengan password di-*hash* menggunakan algoritma `bcrypt`.

### 5.2 Saran Pengembangan

1. **Otomatisasi Pembayaran**: Mengintegrasikan API **Midtrans** atau **Xendit** agar verifikasi pembayaran tidak perlu dilakukan secara manual oleh Admin, mengurangi latensi konfirmasi booking.
2. **Notifikasi Real-time**: Menambahkan sistem notifikasi email (via PHPMailer/SMTP) atau SMS ketika status booking berubah (confirmed, rejected, jatuh tempo).
3. **Keamanan File Upload**: Menambahkan validasi *magic bytes* pada file KTP dan bukti bayar, serta enkripsi file sensitif di server menggunakan `openssl`.
4. **Multi-Item Booking**: Mengembangkan keranjang belanja (*cart*) sehingga pelanggan dapat menyewa beberapa produk berbeda dalam satu transaksi, memanfaatkan tabel `booking_detail` yang sudah dirancang untuk skenario ini.
5. **Ekspansi Platform**: Membangun aplikasi mobile menggunakan **Flutter** yang terhubung ke REST API dari sistem RENTCAM ini, dengan memanfaatkan struktur MVC yang sudah modular.
6. **Backup Database Otomatis**: Menjadwalkan *cronjob* backup database `rentcam.sql` secara berkala (harian/mingguan) untuk mencegah kehilangan data.

---

## DAFTAR PUSTAKA

1. British Computer Society. (2023). *Software Development Best Practices*. BCS Publishing.
2. CodeIgniter Foundation. (2024). *CodeIgniter 3.1.13 User Guide*. https://codeigniter.com/userguide3/
3. MySQL AB. (2024). *MySQL 8.0 Reference Manual: InnoDB Locking*. https://dev.mysql.com/doc/refman/8.0/en/innodb-locking.html
4. Chart.js Contributors. (2024). *Chart.js Documentation v4*. https://www.chartjs.org/docs/
5. SweetAlert2 Team. (2024). *SweetAlert2 Documentation*. https://sweetalert2.github.io/
6. AOS Library. (2024). *Animate On Scroll Library*. https://michalsnik.github.io/aos/
7. OWASP Foundation. (2023). *OWASP Top Ten Security Risks*. https://owasp.org/www-project-top-ten/
8. Tim Pengembang RENTCAM. (2024). *Internal Technical Documentation — docs.md*. Repository 4IKRB.

---

## LAMPIRAN

### Lampiran A — Screenshot Antarmuka Sistem

- **A.1** Screenshot Landing Page (Hero Section & Katalog Produk)
- **A.2** Screenshot Form Booking (Pemilihan Tanggal & Upload KTP)
- **A.3** Screenshot Halaman Upload Bukti Pembayaran
- **A.4** Screenshot Riwayat Booking Member (Status Real-time)
- **A.5** Screenshot Panel Admin — Daftar Booking & Verifikasi Pembayaran
- **A.6** Screenshot Dashboard Super Admin (Chart.js Pendapatan Bulanan)
- **A.7** Screenshot Laporan Produk Terlaris & Ekspor CSV

### Lampiran B — Struktur Database

- **B.1** Skema lengkap database `rentcam.sql` (DDL + Seeder)
- **B.2** Diagram Entity Relationship (ERD) — 6 entitas utama

### Lampiran C — Potongan Kode Utama

- **C.1** `Booking_model::place_booking()` — Implementasi Atomic Transaction & Pessimistic Lock
- **C.2** `Booking_model::expire_pending()` — Mekanisme Auto-Cancel Booking
- **C.3** `MY_Controller.php` — Hierarki RBAC: Guest, User, Admin, Superadmin Controller
- **C.4** `Laporan_model::get_pendapatan_bulanan()` — Query Agregasi Pendapatan

### Lampiran D — Konfigurasi Lingkungan Pengembangan

| Komponen | Versi |
|---|---|
| PHP | 8.1.x (via XAMPP) |
| CodeIgniter | 3.1.13 |
| MySQL / MariaDB | 10.4.x (via XAMPP) |
| Apache | 2.4.x (via XAMPP) |
| Browser Uji | Google Chrome, Mozilla Firefox |
| OS Pengembangan | Windows 11 |
