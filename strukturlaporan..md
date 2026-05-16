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

Puji syukur kami panjatkan kehadirat Allah SWT atas rahmat dan hidayah-Nya sehingga kami dapat menyelesaikan laporan pengembangan sistem informasi "RENTCAM — Modern Camera & Drone Rental System".

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
2. [BAB II LANDASAN TEORI](#bab-ii-landasan-theory)
   - 2.1 Framework CodeIgniter 3
   - 2.2 Arsitektur Model-View-Controller (MVC)
   - 2.3 Manajemen Basis Data MySQL
   - 2.4 Library Frontend (AOS, SweetAlert2, Chart.js)
3. [BAB III METODOLOGI](#bab-iii-metodologi)
   - 3.1 Prosedur Penelitian (Waterfall)
   - 3.2 Analisis Sistem (Flowchart & DFD)
   - 3.3 Perancangan Database (ERD)
4. [BAB IV HASIL DAN PEMBAHASAN](#bab-iv-hasil-dan-pembahasan)
   - 4.1 Implementasi Backend (Controller & Model)
   - 4.2 Implementasi Frontend (Responsive UI)
   - 4.3 Fitur Unggulan (Booking & Analytics)
5. [BAB V PENUTUP](#bab-v-penutup)
   - 5.1 Kesimpulan
   - 5.2 Saran Pengembangan
6. [DAFTAR PUSTAKA](#daftar-pustaka)
7. [LAMPIRAN](#lampiran)

---

## BAB I PENDAHULUAN

### 1.1 Latar Belakang
Workshop RENTCAM menghadapi tantangan operasional akibat lonjakan permintaan sewa kamera DSLR, Mirrorless, dan Drone. Sistem manual yang selama ini digunakan melalui WhatsApp sering menyebabkan data booking bertumpuk, bukti transfer terselip, dan ketidakpastian stok bagi pelanggan. Diperlukan platform yang menyediakan transparansi stok dan alur transaksi yang terverifikasi secara sistematis.

### 1.2 Rumusan Masalah
1. Bagaimana mengintegrasikan stok barang secara real-time agar tidak terjadi *over-booking*?
2. Bagaimana memvalidasi bukti pembayaran pelanggan secara efisien melalui panel Admin?
3. Bagaimana menyajikan tren pendapatan bulanan untuk mendukung pengambilan keputusan bisnis?

### 1.3 Batasan Masalah
1. Sistem dikembangkan menggunakan PHP (CodeIgniter 3) dan database MySQL.
2. Pembayaran masih menggunakan metode transfer manual dengan fitur upload bukti bayar.
3. Kategori produk dibatasi pada perangkat Kamera dan Drone beserta aksesorisnya.

### 1.4 Tujuan
Membangun aplikasi RENTCAM yang mampu menangani siklus sewa dari pendaftaran user, pemilihan alat berdasarkan ketersediaan stok, verifikasi pembayaran oleh admin, hingga pelaporan keuangan otomatis.

---

## BAB II LANDASAN TEORI

### 2.1 Framework CodeIgniter 3
CodeIgniter 3 (CI3) dipilih sebagai basis pengembangan karena memiliki performa yang ringan (*small footprint*) dan dokumentasi yang sangat lengkap. Framework ini menyediakan berbagai *library* bawaan seperti *Database Class*, *Session Management*, dan *File Uploading* yang mempercepat proses pengembangan sistem RENTCAM.

### 2.2 Arsitektur Model-View-Controller (MVC)
Sistem ini mengadopsi pola arsitektur MVC untuk memisahkan logika utama dengan tampilan:
- **Model**: Mengelola data dan interaksi dengan basis data (contoh: `Booking_model.php`).
- **View**: Menangani presentasi data kepada pengguna (contoh: `views/user/produk/detail.php`).
- **Controller**: Bertindak sebagai perantara yang memproses input pengguna dan memanggil Model serta View yang sesuai (contoh: `controllers/Booking.php`).

### 2.3 Manajemen Basis Data MySQL
MySQL digunakan untuk menyimpan data relasional secara efisien. Dengan dukungan *indexing* dan *foreign keys*, sistem menjamin integritas data antara tabel `users`, `booking`, dan `produk`. Konfigurasi database dikelola melalui file `application/config/database.php`.

### 2.4 Library Frontend (AOS, SweetAlert2, Chart.js)
Untuk menciptakan pengalaman pengguna yang premium, sistem mengintegrasikan beberapa library modern:
- **AOS (Animate On Scroll)**: Memberikan efek visual dinamis saat pengguna menjelajahi halaman landing dan katalog.
- **SweetAlert2**: Digunakan untuk menampilkan pesan konfirmasi transaksi dan notifikasi error dengan desain yang lebih elegan dibandingkan alert bawaan browser.
- **Chart.js**: Library berbasis JavaScript untuk merender grafik statistik pendapatan pada dashboard admin, memudahkan pemantauan performa bisnis secara visual.

---

## BAB III METODOLOGI

### 3.1 Prosedur Penelitian (Waterfall)
Pengembangan sistem RENTCAM mengikuti metode Waterfall yang mencakup tahapan:
1. **Requirement Analysis**: Mengidentifikasi kebutuhan fungsional seperti booking dan laporan.
2. **System Design**: Perancangan database (ERD) dan alur sistem (Flowchart/DFD).
3. **Implementation**: Penulisan kode menggunakan PHP dan CI3.
4. **Integration & Testing**: Pengujian fitur oleh tim pengembang.
5. **Operation & Maintenance**: Penyebaran sistem ke lingkungan server lokal (XAMPP).

### 3.2 Analisis Sistem (Flowchart & DFD)
Analisis dilakukan dengan memetakan alur bisnis melalui **Flowchart** (dari pendaftaran hingga pengembalian alat) dan **Data Flow Diagram (DFD)**. DFD Level 1 membagi sistem menjadi 5 proses utama, sementara DFD Level 2 merinci proses transaksi booking untuk memastikan validasi stok dilakukan secara presisi sebelum data disimpan.

### 3.3 Perancangan Database (ERD)
Entity Relationship Diagram (ERD) dirancang untuk meminimalkan redundansi data. Relasi utama meliputi:
- **Users ke Booking**: Relasi *one-to-many* (satu pengguna bisa banyak sewa).
- **Booking ke Pembayaran**: Relasi *one-to-one* (satu transaksi satu bukti bayar).
- **Booking ke Booking_Detail**: Relasi *one-to-many* untuk mendukung sewa banyak item dalam satu transaksi.
- **Produk ke Review**: Relasi *one-to-many* untuk menampung feedback dari penyewa.

---

## BAB IV HASIL DAN PEMBAHASAN

### 4.1 Implementasi Backend (Controller & Model)
Backend dibangun dengan fokus pada keamanan dan validitas data.
- **Controller**: Mengelola permintaan HTTP, seperti `Booking.php` yang memproses form input dan `Auth.php` untuk enkripsi password.
- **Model**: Berisi *query* database terstruktur, menggunakan *Active Record* CodeIgniter untuk mencegah *SQL Injection*. Contoh: `Booking_model->insert_booking()` dan `Produk_model->get_all_produk()`.

### 4.2 Implementasi Frontend (Responsive UI)
Tampilan menggunakan HTML5 dan Vanilla CSS3 dengan pendekatan *Mobile First*. Dashboard admin dirancang menggunakan layout grid untuk kenyamanan navigasi, sementara halaman produk dilengkapi dengan galeri foto dan spesifikasi detail yang responsif di berbagai ukuran layar.

### 4.3 Fitur Unggulan (Booking & Analytics)
- **Real-time Booking**: Sistem secara otomatis menghitung durasi sewa dan biaya total. Validasi stok dilakukan pada saat *submit* untuk mencegah konflik data.
- **Business Intelligence (Analytics)**: Dashboard Super Admin menyajikan visualisasi pendapatan bulanan yang dihasilkan dari agregasi data tabel `pembayaran` dan `booking` melalui `Laporan_model.php`.
- **Feedback Loop**: Adanya fitur Rating & Review memungkinkan peningkatan kualitas layanan berdasarkan masukan langsung dari penyewa.

---

## BAB V PENUTUP

### 5.1 Kesimpulan
Sistem RENTCAM telah berhasil menjawab tantangan manual di workshop dengan menyediakan sistem booking yang terstruktur. Penggunaan framework CI3 dan database relasional terbukti stabil dalam menangani transaksi simultan dan manajemen inventaris.

### 5.2 Saran
1. **Otomatisasi Pembayaran**: Mengintegrasikan API **Midtrans** agar verifikasi pembayaran tidak perlu dilakukan secara manual oleh Admin.
2. **Keamanan**: Menambahkan enkripsi pada upload file KTP dan sistem backup database berkala.
3. **Ekspansi Platform**: Membangun aplikasi mobile menggunakan **Flutter** yang terhubung ke REST API sistem RENTCAM ini.

---

## DAFTAR PUSTAKA
1. British Computer Society. (2023). *Software Development Best Practices*.
2. CodeIgniter Foundation. (2024). *CodeIgniter 3.1.13 Documentation*. codeigniter.com
3. MySQL AB. (2024). *MySQL Reference Manual*. dev.mysql.com
4. Laporan Tim Pengembang RENTCAM. (2024). *Internal Documentation docs.md*.

---

## LAMPIRAN
- **Screenshot Dashboard Super Admin** (Visualisasi Chart.js)
- **Screenshot Katalog Produk** (Responsive Grid)
- **Struktur Tabel Database `rentcam.sql`**
