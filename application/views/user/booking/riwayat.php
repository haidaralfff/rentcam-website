<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/navbar'); ?>

<div style="max-width:1000px; margin:40px auto 100px; padding:0 20px">
    <!-- Premium Header -->
    <div class="history-header" data-aos="fade-down">
        <div style="position:relative; z-index:2; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:20px;">
            <div>
                <h1 style="font-family:'Poppins', sans-serif; font-size:32px; font-weight:800; margin-bottom: 8px; letter-spacing:-1px;">Riwayat <span style="color:#60A5FA">Booking</span></h1>
                <p style="font-size:16px; color:rgba(255,255,255,0.7); font-weight:400;">Pantau dan kelola seluruh transaksi penyewaan alat Anda di sini.</p>
            </div>
            <a href="<?= site_url('produk') ?>" class="btn btn-primary" style="background:#2563EB; border:none; box-shadow: 0 10px 20px rgba(37,99,235,0.3);">
                <i class="fas fa-plus-circle" style="margin-right:8px;"></i> Sewa Alat Baru
            </a>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" style="border-radius:16px; margin-bottom:30px; border:none; background:#F0FDF4; color:#16A34A; box-shadow:0 4px 12px rgba(22,163,74,0.05);">
        <i class="fas fa-check-circle" style="margin-right:8px;"></i> <?= $this->session->flashdata('success') ?>
    </div>
    <?php endif; ?>

    <?php if (empty($bookings)): ?>
    <div style="text-align:center; padding:100px 20px; background: #fff; border-radius: 32px; border: 1px solid rgba(15, 23, 42, 0.05); box-shadow: 0 20px 50px rgba(0,0,0,0.03);" data-aos="zoom-in">
        <div style="width:120px; height:120px; border-radius:40px; background:linear-gradient(135deg, #EFF6FF, #DBEAFE); display:flex; align-items:center; justify-content:center; margin:0 auto 30px; color:#2563EB; font-size:50px; box-shadow: 0 15px 30px rgba(37, 99, 235, 0.1);">
            <i class="fas fa-ghost"></i>
        </div>
        <h3 style="font-family:'Poppins', sans-serif; font-size:28px; font-weight:800; color:#0F172A; margin-bottom:16px; letter-spacing:-0.5px">Ups! Masih Kosong</h3>
        <p style="color:#64748B; max-width:480px; margin:0 auto 40px; line-height:1.8; font-size:16px">Anda belum memiliki riwayat penyewaan. Ayo mulai petualangan karya Anda dengan peralatan kamera dan drone terbaik dari kami!</p>
        <a href="<?= site_url('produk') ?>" class="btn btn-primary btn-lg" style="padding:16px 40px; border-radius:100px; font-weight:700;">
            <i class="fas fa-rocket" style="margin-right:10px;"></i> Explore Katalog Sekarang
        </a>
    </div>
    <?php else: ?>

    <div style="display:flex; flex-direction:column; gap:20px">
        <?php foreach ($bookings as $b): ?>
        <div class="history-card" data-aos="fade-up">
            <!-- Product Thumbnail -->
            <div class="history-img-box">
                <?php if (!empty($b->foto_produk)): ?>
                    <img src="<?= base_url('assets/uploads/produk/' . explode(', ', $b->foto_produk)[0]) ?>" alt="Produk">
                <?php else: ?>
                    <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#F1F5F9; color:#94A3B8;">
                        <i class="fas fa-camera fa-2x"></i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Booking Info -->
            <div class="history-info">
                <div style="display:flex; align-items:flex-start; justify-content:space-between; margin-bottom:8px; gap:10px; flex-wrap:wrap;">
                    <div>
                        <div style="font-size:12px; color:#64748B; font-weight:600; text-transform:uppercase; letter-spacing:1px; margin-bottom:4px;">ID Booking: #<?= $b->id ?></div>
                        <h3 style="font-family:'Poppins', sans-serif; font-size:18px; font-weight:800; color:#0F172A; margin:0; line-height:1.3;"><?= $b->nama_produk ?></h3>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:20px; font-weight:900; color:#2563EB;"><?= rupiah($b->total_harga) ?></div>
                        <div style="font-size:11px; color:#94A3B8; font-weight:600; text-transform:uppercase;">Total Transaksi</div>
                    </div>
                </div>

                <div style="display:flex; align-items:center; gap:15px; margin-bottom:15px; flex-wrap:wrap;">
                    <div style="font-size:13px; color:#475569; display:flex; align-items:center; gap:6px;">
                        <i class="far fa-calendar-alt" style="color:#2563EB"></i> <?= tgl_indo($b->tanggal_mulai) ?> — <?= tgl_indo($b->tanggal_selesai) ?>
                    </div>
                    <?php if ($b->status === 'pending' && !empty($b->deadline_bayar)): ?>
                        <div style="font-size:12px; color:#EF4444; font-weight:700; background:rgba(239, 68, 68, 0.05); padding:2px 10px; border-radius:6px; display:flex; align-items:center; gap:6px;">
                            <i class="fas fa-clock"></i> Batas Bayar: <?= date('d/m H:i', strtotime($b->deadline_bayar)) ?>
                        </div>
                    <?php endif; ?>
                </div>

                <div style="display:flex; align-items:center; justify-content:space-between; gap:15px; flex-wrap:wrap; padding-top:15px; border-top:1px dashed #E2E8F0;">
                    <div style="display:flex; gap:10px; align-items:center;">
                        <!-- Status Booking -->
                        <?php 
                            $status_class = '';
                            $status_icon = '';
                            switch($b->status) {
                                case 'confirmed': $status_class = 'status-verified'; $status_icon = 'check-double'; break;
                                case 'pending': $status_class = 'status-pending'; $status_icon = 'hourglass-half'; break;
                                case 'batal': $status_class = 'status-rejected'; $status_icon = 'times-circle'; break;
                                case 'kembali': $status_class = 'status-returned'; $status_icon = 'undo'; break;
                                default: $status_class = 'status-pending'; $status_icon = 'info-circle';
                            }
                        ?>
                        <span class="history-status-pill <?= $status_class ?>">
                            <i class="fas fa-<?= $status_icon ?>"></i> <?= ucfirst($b->status) ?>
                        </span>

                        <!-- Status Bayar -->
                        <?php if ($b->status_bayar): ?>
                            <?php 
                                $bayar_class = '';
                                switch($b->status_bayar) {
                                    case 'verified': $bayar_class = 'status-verified'; break;
                                    case 'pending': $bayar_class = 'status-pending'; break;
                                    case 'rejected': $bayar_class = 'status-rejected'; break;
                                }
                            ?>
                            <span class="history-status-pill <?= $bayar_class ?>">
                                <i class="fas fa-receipt"></i> Bayar: <?= ucfirst($b->status_bayar) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div style="display:flex; gap:10px;">
                        <?php if ($b->status === 'kembali'): ?>
                            <?php if (!empty($b->review_id)): ?>
                                <a href="<?= site_url('produk/detail/'.$b->produk_id) ?>" class="btn btn-outline btn-sm" style="border-radius:10px; font-size:12px;">
                                    <i class="fas fa-check-circle" style="color:#16A34A"></i> Sudah Diulas
                                </a>
                            <?php else: ?>
                                <a href="<?= site_url('review/form/'.$b->id) ?>" class="btn btn-primary btn-sm" style="border-radius:10px; font-size:12px;">
                                    <i class="fas fa-star"></i> Tulis Review
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ($b->status === 'pending' && (!$b->status_bayar || $b->status_bayar === 'rejected')): ?>
                            <a href="<?= site_url('pembayaran/upload/'.$b->id) ?>" class="btn btn-accent btn-sm" style="border-radius:10px; font-size:12px; padding:8px 20px;">
                                <i class="fas fa-cloud-upload-alt"></i> Upload Bukti
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?= site_url('produk/detail/'.$b->produk_id) ?>" class="btn btn-light btn-sm" style="border-radius:10px; font-size:12px; background:#F8FAFC; border:1px solid #E2E8F0;">
                            <i class="fas fa-external-link-alt"></i> Detail
                        </a>
                        <a href="<?= site_url('booking/hapus/'.$b->id) ?>" class="btn btn-danger btn-sm btn-delete-riwayat" style="border-radius:10px; font-size:12px;">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<script>
document.querySelectorAll('.btn-delete-riwayat').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        
        Swal.fire({
            title: 'Hapus Riwayat?',
            text: `Apakah Anda yakin ingin menghapus riwayat booking ini?`,
            icon: 'warning',
            iconColor: '#EF4444',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'swal2-premium-popup',
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-outline'
            },
            buttonsStyling: false,
            backdrop: `rgba(15, 23, 42, 0.5) blur(4px)`
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});
</script>

<?php $this->load->view('templates/footer'); ?>
