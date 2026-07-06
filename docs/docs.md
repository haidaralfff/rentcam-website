# 📸 RENTCAM — Dokumentasi Arsitektur & Alur Kerja Sistem

Dokumen ini menyediakan panduan teknis mendalam mengenai sistem **RENTCAM**, mencakup alur logika bisnis, diagram aliran data (DFD), dan struktur relasi database (ERD).

---

## 1. 🔄 Flowchart Sistem (Alur Bisnis)
Flowchart ini menggambarkan langkah-langkah yang dilalui oleh pengguna dan admin dalam siklus penyewaan.

```mermaid
graph TD
    Start([Mulai]) --> Guest{Status User?}
    Guest -- Belum Login --> Login[Login / Register]
    Guest -- Login --> Katalog[Lihat Katalog Produk]
    
    Login --> Katalog
    Katalog --> Detail[Pilih Alat & Cek Detail]
    Detail --> Form[Isi Form Booking & Upload KTP]
    Form --> Bayar[Upload Bukti Transfer]
    
    Bayar --> Admin{Admin Verifikasi?}
    Admin -- Ditolak --> Batal[Status: Dibatalkan]
    Admin -- Disetujui --> Confirmed[Status: Dibayar]
    
    Confirmed --> Ambil[Ambil Alat di Workshop]
    Ambil --> Disewa[Status: Dipinjam]
    Disewa --> Kembali[Kembalikan Alat]
    Kembali --> Selesai[Status: Selesai]
    Selesai --> Review[Berikan Rating & Ulasan]
    Review --> End([Selesai])
```

---

## 2. 📊 Data Flow Diagram (DFD)

### DFD Level 0 (Context Diagram)
Menggambarkan interaksi antara entitas eksternal dengan sistem RENTCAM secara global.

```mermaid
graph LR
    User((User)) <-->|Data Booking, Bukti Bayar, Review| System[("SISTEM RENTCAM")]
    Admin((Admin)) <-->|Data Produk, Verifikasi Bayar| System
    SAdmin((Super Admin)) <-->|Kelola User, Laporan Keuangan| System
```

### DFD Level 1 (Process Diagram)
Memecah sistem menjadi proses-proses utama.

```mermaid
graph TD
    U((User))
    A((Admin))
    SA((Super Admin))
    
    D1[(Users)]
    D2[(Produk)]
    D3[(Booking)]
    D4[(Pembayaran)]
    
    U -->|Login/Reg| P1(1.0 Autentikasi)
    P1 <--> D1
    
    A -->|Manajemen Alat| P2(2.0 Kelola Produk)
    P2 <--> D2
    
    U -->|Pilih Alat| P3(3.0 Transaksi Booking)
    P3 --> D3
    P3 --> D2
    
    U -->|Upload Bukti| P4(4.0 Verifikasi Pembayaran)
    A -->|Approve/Reject| P4
    P4 <--> D4
    P4 --> D3
    
    SA -->|Generate| P5(5.0 Pelaporan & Analytics)
    P5 <--> D3
    P5 <--> D4
```

### DFD Level 2 (Detailed Booking Process)
Penjelasan mendalam mengenai proses transaksi booking.

```mermaid
graph TD
    U((User))
    D2[(Produk)]
    D3[(Booking)]
    D3D[(Booking Detail)]

    U -->|Pilih Produk| P31(3.1 Cek Stok Tersedia)
    P31 <--> D2
    P31 -->|Tersedia| P32(3.2 Simpan Header Booking)
    P32 --> D3
    P32 --> P33(3.3 Simpan Item Detail)
    P33 --> D3D
    P33 -->|Update Stok| D2
```

---

## 3. 🔄 State Management (Status Transaksi)

Sistem melacak siklus hidup penyewaan melalui kolom `status` di tabel `booking`:

```mermaid
stateDiagram-v2
    [*] --> Pending : Booking dibuat
    Pending --> Confirmed : Admin verifikasi pembayaran
    Pending --> Batal : Deadline bayar lewat / ditolak admin
    Confirmed --> Dipinjam : Admin serahkan barang
    Dipinjam --> Kembali : Admin terima barang kembali
    Kembali --> [*] : Selesai
```

1.  **Pending**: User sudah isi form, tapi belum bayar/verifikasi. Stok di-*hold* (soft reservation).
2.  **Confirmed**: Admin sudah verifikasi pembayaran. Alat siap diambil.
3.  **Dipinjam**: Alat sedang digunakan oleh penyewa (*In Progress*).
4.  **Kembali**: Alat sudah pulang. Stok kembali bertambah secara otomatis.
5.  **Batal**: Booking hangus (melewati *deadline* bayar 1x24 jam) atau ditolak admin.

---

## 4. 🔄 Sequence Diagrams

### 4.1 Sequence Diagram: User (Proses Booking & Pembayaran)
Menjelaskan urutan interaksi saat user melakukan penyewaan hingga pembayaran.

```mermaid
sequenceDiagram
    actor User
    participant View as View (Booking Form)
    participant Ctrl as Booking Controller
    participant Mdl as Booking Model
    participant DB as Database

    User->>View: Isi Data Booking & Upload KTP
    View->>Ctrl: submit_booking()
    Ctrl->>Mdl: cek_ketersediaan(produk_id, tgl)
    Mdl->>DB: query stok
    DB-->>Mdl: data stok
    alt Stok Tersedia
        Mdl-->>Ctrl: true
        Ctrl->>Mdl: place_booking(data)
        Mdl->>DB: insert booking & detail
        DB-->>Mdl: booking_id
        Mdl-->>Ctrl: success
        Ctrl-->>View: Redirect ke Upload Pembayaran
        User->>View: Upload Bukti Transfer
        View->>Ctrl: upload_pembayaran()
        Ctrl->>DB: insert pembayaran (status: pending)
    else Stok Kosong
        Mdl-->>Ctrl: false
        Ctrl-->>View: Tampilkan Error "Stok Tidak Mencukupi"
    end
```

### 4.2 Sequence Diagram: Admin (Verifikasi & Kelola Produk)
Menjelaskan bagaimana Admin mengelola inventori dan memvalidasi transaksi.

```mermaid
sequenceDiagram
    actor Admin
    participant Dash as Dashboard Admin
    participant Ctrl as Admin Controller
    participant DB as Database

    Admin->>Dash: Masuk Menu Pembayaran
    Dash->>Ctrl: get_pending_payments()
    Ctrl->>DB: select * from pembayaran where status=pending
    DB-->>Ctrl: list data
    Ctrl-->>Dash: Tampilkan List Pembayaran
    Admin->>Dash: Klik Verifikasi (Approve)
    Dash->>Ctrl: update_status(verified)
    Ctrl->>DB: update status pembayaran & booking
    DB-->>Ctrl: success
    Ctrl-->>Dash: Notifikasi Berhasil

    Admin->>Dash: Tambah Produk Baru
    Dash->>Ctrl: store_product(data)
    Ctrl->>DB: insert into produk
    DB-->>Dash: Tampilkan di Katalog
```

### 4.3 Sequence Diagram: Super Admin (Manajemen Akun & Laporan)
Menjelaskan kontrol otoritas tertinggi dan akses data analitik.

```mermaid
sequenceDiagram
    actor SAdmin as Super Admin
    participant Dash as Dashboard SAdmin
    participant Ctrl as Laporan Controller
    participant DB as Database

    SAdmin->>Dash: Pilih Filter Tahun Laporan
    Dash->>Ctrl: get_laporan_tahunan(tahun)
    Ctrl->>DB: sum(total_harga) group by month
    DB-->>Ctrl: data pendapatan
    Ctrl-->>Dash: Tampilkan Grafik Pendapatan

    SAdmin->>Dash: Kelola Data User/Admin
    Dash->>Ctrl: delete_user(user_id)
    Ctrl->>DB: delete from users where id=user_id
    DB-->>Dash: Refresh List User
```

---

## 5. 📝 Penjelasan Teknis Diagram
Struktur database yang menggambarkan hubungan antar tabel di RENTCAM.

```mermaid
erDiagram
    USERS ||--o{ BOOKING : makes
    USERS ||--o{ REVIEW : writes
    PRODUK ||--o{ BOOKING_DETAIL : contained_in
    BOOKING ||--|| PEMBAYARAN : confirmed_by
    BOOKING ||--o{ BOOKING_DETAIL : has
    BOOKING ||--o{ REVIEW : has
    PRODUK ||--o{ REVIEW : receives

    USERS {
        int id PK
        string nama
        string email
        string password
        string role "user/admin/superadmin"
        tinyint status "1=aktif/0=nonaktif"
        datetime created_at
    }

    PRODUK {
        int id PK
        string nama
        string kategori "kamera/drone/aksesoris"
        text spesifikasi
        int harga_per_hari
        int stok
        string foto
        string status "tersedia/tidak_tersedia"
        datetime created_at
    }

    BOOKING {
        int id PK
        int user_id FK
        date tanggal_mulai
        date tanggal_selesai
        int total_harga
        string status "pending/confirmed/dipinjam/kembali/batal"
        datetime deadline_bayar "1x24 jam"
        string phone
        text alamat
        string ktp
        string foto_penerima
        text catatan
        datetime deleted_at "soft delete"
        datetime created_at
    }

    BOOKING_DETAIL {
        int id PK
        int booking_id FK
        int produk_id FK
        int qty
        int harga_satuan
    }

    PEMBAYARAN {
        int id PK
        int booking_id FK
        string metode "transfer"
        string bukti_bayar
        string status "pending/verified/rejected"
        text catatan_admin
        datetime created_at
    }

    REVIEW {
        int id PK
        int user_id FK
        int produk_id FK
        int booking_id FK
        tinyint rating "1-5"
        text komentar
        datetime created_at
    }
```

---

### Penjelasan DFD
*   **DFD Level 0**: Menunjukkan bahwa sistem menerima input dari User (data booking), Admin (update stok), dan Super Admin (kontrol akun).
*   **DFD Level 1**: Membagi logika sistem menjadi 5 modul besar: Autentikasi, Inventori, Booking, Pembayaran, dan Reporting.
*   **DFD Level 2**: Menekankan pada keamanan stok. Sistem tidak akan memproses booking jika `get_available_stok` dari produk tidak mencukupi pada rentang tanggal yang dipilih.

### Penjelasan ERD
*   **One-to-Many (Users-Booking)**: Satu pengguna dapat melakukan banyak transaksi penyewaan.
*   **One-to-One (Booking-Pembayaran)**: Setiap satu ID Booking hanya memiliki satu catatan pembayaran (bukti transfer).
*   **Master-Detail (Booking-BookingDetail)**: Memungkinkan pengembangan di masa depan jika sistem mendukung satu kali checkout untuk banyak jenis alat sekaligus (saat ini diimplementasikan 1:1 untuk kesederhanaan).
*   **Review Relation**: Review memiliki *unique constraint* pada pasangan `(user_id, produk_id)`, sehingga satu pengguna hanya dapat memberikan **satu ulasan per produk**. Kolom `booking_id` tetap disimpan untuk referensi transaksi, tetapi validasi duplikasi dilakukan di level user-produk.

### 🧹 Kebijakan Manajemen Data (Data Deletion)
Sistem ini menggunakan mekanisme **Soft Delete** untuk menjaga integritas data keuangan:
1. **Soft Delete**: Saat data *Booking* "dihapus" (oleh User di menu Riwayat, atau oleh Admin), data tidak benar-benar dihapus dari database. Kolom `deleted_at` diisi timestamp, dan seluruh query baca difilter dengan `WHERE deleted_at IS NULL`. Data tetap tersimpan utuh untuk keperluan audit dan laporan keuangan.
2. **Physical File Deletion**: Untuk menjaga kapasitas storage, penghapusan data pembayaran dari dashboard Admin akan turut memicu fungsi *unlink()* yang menghapus file gambar bukti transfer dari direktori `/assets/uploads/`. Sama halnya dengan file *foto penerima* saat serah terima.


